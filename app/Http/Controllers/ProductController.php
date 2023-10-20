<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Session;
use Illuminate\Support\Facades\DB;

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

            return redirect('/');
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
            ->select('products.id','products.name','products.price','cart.quantity','products.gallery','cart.id as cart_id')
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
        }

        Cart::where("user_id", $userId)->delete();
        return redirect('/');
        //return $req->input();
    }

    function myOrder(){
        $userId = Session::get('user')['id'];

        $data = DB::table('orders')
            ->join('products', 'orders.product_id', 'products.id')
            ->select('products.id','products.name','products.price','products.gallery','orders.quantity','orders.status','orders.payment_method','orders.id','orders.purchase_date')
            ->where('orders.user_id', $userId)
            ->get();

        return view('myorder',['products'=> $data]);
    }

}
