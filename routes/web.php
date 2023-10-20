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

Route::get('/product', function () {
    return view('product');
});

Route::get('/forher', function () {
    return view('forher');
});

Route::get('/logout', function () {
    Session::forget('user');
    return redirect('/');
});


Route::post("/login",[UserController::class,'login']);

Route::get("/",[ProductController::class,'index']);

Route::get('/forher', [ProductController::class, 'forHer']);

Route::get('detail/{id}', [ProductController::class,'detail']);

Route::get('search', [ProductController::class,'search']);

Route::post('add_to_cart', [ProductController::class,'addToCart']);

Route::post('/update_cart', [ProductController::class,'updateCart']);

Route::get('cartlist', [ProductController::class,'cartList']);

Route::get('removecart/{id}',[ProductController::class,'removeCart']);

Route::post('/checkout', [ProductController::class,'orderNow']);

Route::get('orderNow', [ProductController::class,'order']);

Route::post('/orderplace',[ProductController::class,'orderPlace']);

Route::get('myorder',[ProductController::class,'myOrder']);

