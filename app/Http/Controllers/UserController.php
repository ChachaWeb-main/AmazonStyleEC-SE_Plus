<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth; //追加
use Illuminate\Http\Request;

class UserController extends Controller
{
    // mypageアクションを追加。
    public function mypage()
    {
        // Auth::user()を使い、ユーザー自身の情報を$userに保存して、ビューへ渡し、ビュー側で表示させる。
        $user = Auth::user();

        return view('users.mypage', compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // maypageと同様に、ユーザーの情報をAuth::user()で取得し、ビューへ
        $user = Auth::user();

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = Auth::user();

        $user->name = $request->input('name') ? $request->input('name') : $user->name;
        $user->email = $request->input('email') ? $request->input('email') : $user->email;
        $user->postal_code = $request->input('postal_code') ? $request->input('postal_code') : $user->postal_code;
        $user->address = $request->input('address') ? $request->input('address') : $user->address;
        $user->phone = $request->input('phone') ? $request->input('phone') : $user->phone;
        $user->update();

        return redirect()->route('mypage');
    }
    
    // 会員の住所変更を行うページ用。
    public function edit_address()
    {
        $user = Auth::user();

        return view('users.edit_address', compact('user'));
    }
    
    // パスワード変更画面を表示するedit_passwordアクションを作成。
    public function edit_password()
    {
        return view('users.edit_password');
    }
    
    public function update_password(Request $request)
    {
        $user = Auth::user();

        /* 送信されたリクエスト内のpasswordとpassword_confirmationが同一のものであるかどうかを確認し、
        同じである場合のみパスワードを暗号化しデータベースへと保存。*/
        if ($request->input('password') == $request->input('password_confirmation')) {
            $user->password = bcrypt($request->input('password'));
            $user->update();
        } else {
            // 異なっていた場合は、パスワード変更画面へとリダイレクト。
            return redirect()->route('mypage.edit_password');
        }

        return redirect()->route('mypage');
    }
}