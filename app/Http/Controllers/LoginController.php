<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //住民用ログイン画面
    public function show()
    {
        return view('login');
    }

    //今回は確認用に"/login"を入れれば見れるように。
    //のちにloginと紐づけしなければならない
    //住民用システム画面
    public function login()
    {
        return view('residentUI');
    }


}
