<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function login()
    {
        $user = session('username');
        if(isset($user)){
            return redirect('/');
        }
        return view('login');
    }

    public function auth(Request $request)
    {
        if($request->isMethod('POST')){
            $userName = $request->input('username');
            $password = $request->input('password');
            $user = \DB::table('user')->where('username', $userName)->first();
            $is_success = false;
            if(isset($user) && $user->password == $password){
                session(['username' => $user->username]);
                session(['full_name' => $user->full_name]);
                session(['id' => $user->id]);
                $is_success = true;
            }
            if ($is_success == true) {
                return redirect('/');
            } else {
                $error = true;
                return view('login',compact('error'));
            }
        }
        return "";
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}