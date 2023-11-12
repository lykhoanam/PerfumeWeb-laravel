<?php

namespace App\Http\Controllers;

use App\Models\OrdersFake;
use Auth;
use Http;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetail;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;

class ProductController extends Controller
{
    //
    function index(){

        $user = Session::get('user');

        if ($user && isset($user['id'])) {
            $data = Product::all();
            return view('product', ['products'=>$data]);
        }

        $data1 = Product::all();
        return view('product', ['products'=>$data1]);
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
            ->select('products.id','products.name','products.price','cart.quantity','products.gallery','cart.id as cart_id','users.name as username','users.id as user_id')
            ->where('cart.product_id', $productId)
            ->first();  // Use first() to get a single result

            if ($productId) {
                $cartProducts[] = $productId;
                $total+= $productId->price * $productId->quantity;
            }
        }

       /* foreach ($cartProducts as $product) {
            OrdersFake::create([
                'product_id' => $product->id,
                'user_id' => $product->user_id, // Adjust as needed
                'quantity' => $product->quantity,
                'status' => 0, // Adjust as needed
                // Other fields if needed
            ]);
        }*/

        session(['cart' => $cartProducts]);

        return view('order',['products' => $cartProducts,'totalAmount' => $total]);

        /*$total = 0;

        foreach ($cartProducts as $product) {
            $total+= $product->price * $product->quantity;
        }

        return $total;*/
    }


    function orderPlace(Request $req){
        $userId = Session::get('user')['id'];
        $user = User::find($userId);

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

        $address = $req->input('address');
        $paymentMethod = $req->payment;
        $message = $req->input('message');
        $totalAmount = $req->input('totalAmount');

        if($paymentMethod == 'Online'){
            Mail::to($user->email)->send(new MailNotify("Vietcombank","1023770449",$address, $paymentMethod, $message, $totalAmount));
        }



        $orderSuccess = "Mua hàng thành công!!!!";
        Cart::where("user_id", $userId)->delete();

        return view('product',['success' => $orderSuccess]);
        //return $req->input();
    }


    //Momo payment

    public function momo_payment(Request $request){



    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


    $partnerCode = 'MOMOBKUN20180529';
    $accessKey = 'klm05TvNBzhg7h7j';
    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
    $orderInfo = "Thanh toán qua MoMo";
    $amount = "10000";
    $orderId = time() ."";
    $redirectUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
    $ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
    $extraData = "";




    $serectkey = $secretKey;



    $requestId = time() . "";
    $requestType = "payWithATM";
    //before sign HMAC SHA256 signature
    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
    $signature = hash_hmac("sha256", $rawHash, $serectkey);
    $data = array('partnerCode' => $partnerCode,
        'partnerName' => "Test",
        "storeId" => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature);
    $result = $this->execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true);




    return redirect()->to($jsonResult['payUrl']);

    }




    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }




    public function vnpay_payment(Request $req){
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/product";
        $vnp_TmnCode = "FK0N8JVO";//Mã website tại VNPAY
        $vnp_HashSecret = "UTKZRGBGLNJSKVTGKSDOEVBZJPKTIRUB"; //Chuỗi bí mật

        $vnp_TxnRef = rand(0, 10000); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán VNPay';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $req->totalAmount * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        //$vnp_ExpireDate = $_POST['txtexpire'];
        //Billing

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,

        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        //if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        //    $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        //}

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                //Theem san pham vao Order
                $userId = Session::get('user')['id'];
                $user = User::find($userId);

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
                    $order->payment_method= "VNPay";
                    $order->payment_status = "Đã thanh toán";
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

                return redirect()->to($vnp_Url)->with('success',$orderSuccess);
                //return view($vnp_Url, ['success' => $orderSuccess]);
            } else {
                echo json_encode($returnData);
            }
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
        $orderDetail->status = 3;
        $orderDetail->save();

        // Refund the product quantity
        $product = Product::find($orderDetail->product_id);
        $product->quantity += $orderDetail->quantity;
        $product->save();

        return redirect()->back()->with('success', 'Order cancelled successfully.');
    }

}
