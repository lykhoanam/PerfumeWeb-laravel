<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentConfirmation;

class ProductController extends Controller
{
    //
    function index(){
        $data = Product::all();
        return view('product', ['products'=>$data]);
    }

    function forHer()
    {
        $data = Product::where('category', 'forher')->get();
        return view('forher', ['products' => $data]);
    }

    function forHim()
    {
        $data = Product::where('category', 'forhim')->get();
        return view('forhim', ['products' => $data]);
    }

    function uniSex()
    {
        $data = Product::where('category', 'unisex')->get();
        return view('unisex', ['products' => $data]);
    }

    function giftSet()
    {
        $data = Product::where('category', 'giftset')->get();
        return view('giftset', ['products' => $data]);
    }

    function detail($id){
        $data= Product::find( $id );
        return view('detail',['products'=> $data]);
    }

    function search(Request $req){
        $data = Product::where('name','like','%'. $req->input('query').'%')->get();
        if (count($data) > 0) {
            return view('search', ['products' => $data,'query' => $req->input('query')]);
        } else {
            // Nếu không có sản phẩm, lấy danh sách sản phẩm ngẫu nhiên
            $randomProducts = Product::inRandomOrder()->limit(12)->get();

            return view('search', ['products' => $data,'query' => $req->input('query'), 'randomProducts' => $randomProducts]);
        }
    }

    function addToCart(Request $req){
        if ($req->session()->has('user')) {
            $userId = $req->session()->get('user')['id'];
            $productId = $req->product_id;
            $quantity = $req->quantity;


            $existingCart = Cart::where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if ($existingCart) {
                $existingCart->quantity += $quantity;
                $existingCart->save();
            } else {
                $cart = new Cart;
                $cart->user_id = $userId;
                $cart->product_id = $productId;
                $cart->quantity = $quantity;
                $cart->save();
            }

            $success = "Thêm vào giỏi hàng thành công!!!";

            // Lấy thông tin sản phẩm để có thể chuyển hướng đúng
            $product = Product::find($productId);

            // Kiểm tra nếu sản phẩm tồn tại
            if ($product) {
                // Tạo URL chi tiết sản phẩm và chuyển hướng đến đó
               // $url = "/detail/{$product->id}";
                return view('detail')->with(['success' => $success, 'products' => $product]);
            } else {
                // Nếu không tìm thấy sản phẩm, xử lý theo ý của bạn
                return redirect('/'); // Chẳng hạn chuyển hướng về trang chính
            }
        } else {
            return redirect('/login');
        }
    }

    public function updateCart(Request $req)
    {
        if ($req->session()->has('user')) {
            $userId = $req->session()->get('user')['id'];
            $productId = $req->product_id;
            $quantity = $req->quantity;

            $existingCart = Cart::where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if ($existingCart) {
                $existingCart->quantity = $quantity;
                $existingCart->save();
            }

            // Return a JSON response indicating success
            return redirect('/');
        } else {
            return redirect('/login');
        }
    }

    public function cartItem()
    {
        $user = Session::get('user');

        if ($user && isset($user['id'])) {
            $userId = $user['id'];
            return Cart::where('user_id', $userId)->count();
        }

        return 0;
    }

    // ProductController.php
    public function cartList()
    {
        $userId = Session::has('user') ? Session::get('user')['id'] : null;

        $data = DB::table('cart')
            ->join('products', 'cart.product_id', 'products.id')
            ->select('products.id','products.name','products.price','products.gallery','cart.quantity','cart.id as cart_id')
            ->where('cart.user_id', $userId)
            ->get();

        $randomProducts = Product::inRandomOrder()->limit(12)->get();

        return view('cartlist', ['products' => $data, 'randomProducts' => $randomProducts]);
    }

    function removeCart($id){
        Cart::destroy($id);
        return redirect('cartlist');
    }

    function orderNow(Request $req){

        $selectedProductIds = explode(',', $req->input('selected_products_ids'));
        //return Cart::whereIn('id', $selectedProductIds)->get();//sum(DB::raw('CAST(price AS DECIMAL(10, 2))'));
        //return Product::whereIn('id', $selectedProductIds)->get();
        $cartProducts = [];
        $total = 0;
        foreach($selectedProductIds as $productId){
            $productId = DB::table('cart')
            ->join('products', 'cart.product_id', 'products.id')
            ->join('users', 'cart.user_id', 'users.id')
            ->select('products.id','products.name','products.price','cart.quantity','products.gallery','cart.id as cart_id','users.name as username')
            ->where('cart.product_id', $productId)
            ->first();  // Use first() to get a single result

            if ($productId) {
                $cartProducts[] = $productId;
                $total+= $productId->price * $productId->quantity;
            }
        }

        return view('order',['products' => $cartProducts,'totalAmount' => $total]);

        /*$total = 0;

        foreach ($cartProducts as $product) {
            $total+= $product->price * $product->quantity;
        }

        return $total;*/
    }


    function orderPlace(Request $req){
        $userId = Session::get('user')['id'];
        $allcart = Cart::where('user_id', $userId)->get();

        $lastOrderId = OrderDetail::latest()->pluck('id')->first();
        $newId = $lastOrderId + 1;

        foreach($allcart as $cart){
            $order = new Order;
            $order->product_id = $cart['product_id'];
            $order->user_id = $cart['user_id'];
            $order->quantity = $cart['quantity'];
            $order->address = $req->address;
            $order->status = 0;
            $order->payment_method= $req->payment;
            $order->payment_status = "not yet";
            $order->message = $req->message;
            $order->save();

            $orderDetail = new OrderDetail;
            $orderDetail->id = $newId;

            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $cart->product_id;
            $orderDetail->quantity = $cart->quantity;
            $orderDetail->status = 0;
            $orderDetail->save();

            $product = Product::find($cart->product_id);
            $product->quantity -= $cart->quantity;
            $product->save();
        }


        $orderSuccess = "Mua hàng thành công!!!!";
        Cart::where("user_id", $userId)->delete();

        return view('product', ['success' => $orderSuccess]);
        //return $req->input();
    }

    function myOrder(){
        $userId = Session::get('user')['id'];

        $data = DB::table('orders')
        ->join('products', 'orders.product_id', 'products.id')
        ->join('order_details', 'orders.id', 'order_details.order_id') // Assuming there's a foreign key relationship between orders.id and order_details.order_id
        ->select('products.id', 'products.name', 'products.price', 'products.gallery', 'orders.quantity', 'orders.payment_method', 'orders.id as order_id', 'orders.purchase_date','orders.payment_status' ,'order_details.*')
        ->where('orders.user_id', $userId)
        ->get();


        return view('myorder',['products'=> $data]);
    }

    public function cancelOrder($orderDetailId)
    {
        // Find the order detail
        $orderDetail = OrderDetail::find($orderDetailId);

        if (!$orderDetail) {
            // Handle the case where the order detail is not found
            return redirect()->back()->with('error', 'Order detail not found.');
        }

        // Check if the order detail is cancellable (status is not 2 or 4)
        if ($orderDetail->status == 2 || $orderDetail->status == 4) {
            // Handle the case where the order detail is not cancellable
            return redirect()->back()->with('error', 'Order detail is not cancellable.');
        }

        // Update the order detail status to 4 (cancelled)
        $orderDetail->status = 4;
        $orderDetail->save();

        // Refund the product quantity
        $product = Product::find($orderDetail->product_id);
        $product->quantity += $orderDetail->quantity;
        $product->save();

        return redirect()->back()->with('success', 'Order cancelled successfully.');
    }


}
