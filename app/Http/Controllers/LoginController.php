<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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

    //ログイン認証処理
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // ユーザーのroleに応じてリダイレクト先を変更
            $user = Auth::user();
            $role = $user->role;

            // roleに応じたリダイレクト
            if ($role === '自治体' || $role === 'municipality') {
                return redirect()->route('municipality.index');
            } else if ($role === 'hunter') {
                return redirect()->route('hunter.index');
            } else {
                // 住民（resident）またはその他のroleの場合
                return redirect()->route('login');
            }
        }

        throw ValidationException::withMessages([
            'email' => __('認証情報が記録と一致しません。'),
        ]);
    }
}
