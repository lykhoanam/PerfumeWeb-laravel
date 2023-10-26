<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserController extends Controller
{
    //
    function login(Request $req)
    {
        $user = User::where(['email'=>$req->email])->first();
        if(!$user || !Hash::check($req->password,$user->password)){
            $error = 'Sai tên đăng nhập hoặc mật khẩu!!';
            return view('login')->with('error', $error);
        }else{
            $req->session()->put('user',$user);

            $success = "Đăng nhập thành công !!!";

            return view('product', ['success'=> $success]);
        }
    }

    function signup(Request $request)
{
        $user = new User;

        if($request->password_confirm != $request->password){
            $error = 'Xác nhận mật khẩu không khớp!';

            return view('signup')->with('error', $error);
        }else{
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            $user->save();

            $success = "Đăng ký thành công !!!";

            return view('signup', ['success'=> $success]);
        }


    }


}
