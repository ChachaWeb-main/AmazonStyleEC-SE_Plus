<?php

namespace App\Http\Controllers\Dashboard;

use App\User; //追加
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // ユーザーの一覧を表示する。
    public function index(Request $request)
    {
        // $request内に保存された検索キーワードをもとに、ユーザーを検索。
        if ($request->keyword !== null) {
           $keyword = rtrim($request->keyword);
           if (is_int($request->keyword)) {
               $keyword = (string)$keyword;
           }
           $users = User::where('name', 'like', "%{$keyword}%")
                           ->orwhere('email', 'like', "%{$keyword}%")
                           ->orwhere('address', 'like', "%{$keyword}%")
                           ->orwhere('postal_code', 'like', "%{$keyword}%")
                           ->orwhere('phone', 'like', "%{$keyword}%")
                           ->orwhere('id', "{$keyword}")->paginate(15);
        } else {
           $users = User::paginate(15);
           $keyword = "";
        }
       
        return view('dashboard.users.index', compact('users', 'keyword'));
    }
    
    // ユーザーの退会処理。
    public function destroy(User $user)
    {
        // ユーザーが退会済みかどうかをチェック。
        if ($user->deleted_flag) {
           $user->deleted_flag = false;
        } else {
           $user->deleted_flag = true;
        }
        
        $user->update();
        
        return redirect()->route('dashboard.users.index');
    }
}
