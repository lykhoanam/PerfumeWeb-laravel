<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('login');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/product', function () {
    return view('product');
});

Route::get('/forher', function () {
    return view('forher');
});

Route::get('/forhim', function () {
    return view('forhim');
});

Route::get('/unisex', function () {
    return view('unisex');
});

Route::get('/giftset', function () {
    return view('giftset');
});

Route::get('/cartlist', function () {
    return view('cartlist');
});

Route::get('/logout', function () {
    Session::forget('user');
    return redirect('/');
});




Route::post("/signup",[UserController::class,'signup']);

Route::post("/login",[UserController::class,'login']);

Route::get("/",[ProductController::class,'index']);

Route::get('/forher', [ProductController::class, 'forHer']);

Route::get('/forhim', [ProductController::class, 'forHim']);

Route::get('/unisex', [ProductController::class, 'uniSex']);

Route::get('/giftset', [ProductController::class, 'giftSet']);

Route::get('detail/{id}', [ProductController::class,'detail']);

Route::get('search', [ProductController::class,'search']);

Route::post('add_to_cart', [ProductController::class,'addToCart']);

Route::post('/update_cart', [ProductController::class,'updateCart']);

Route::get('cartlist', [ProductController::class,'cartList']);

Route::get('removecart/{id}',[ProductController::class,'removeCart']);

Route::any('/checkout', [ProductController::class,'orderNow']);

Route::get('orderNow', [ProductController::class,'order']);

Route::post('/orderplace',[ProductController::class,'orderPlace']);

Route::get('myorder',[ProductController::class,'myOrder']);

// routes/web.php

Route::post('/cancel-order/{orderDetailId}', [ProductController::class,'cancelOrder'])->name('cancel.order');
