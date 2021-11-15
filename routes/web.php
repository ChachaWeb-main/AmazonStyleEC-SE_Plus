<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ユーザー情報関連の各ルーティングを設定。
Route::get('users/mypage', 'UserController@mypage')->name('mypage');
Route::get('users/mypage/edit', 'UserController@edit')->name('mypage.edit');
Route::get('users/mypage/address/edit', 'UserController@edit_address')->name('mypage.edit_address');
Route::put('users/mypage', 'UserController@update')->name('mypage.update');

/* レビューの内容をデータとしてフォームから送信する必要があるため、Route::postでPOSTで使用するルーティングだと分かるようにコードを。
また、商品のデータを自動的に取得するために、URLをproducts/{product}/reviewsとして、
最後に、使用するコントローラーとそのアクションを、ReviewController@storeと指定。
この設定で、商品のIDを元に自動的にデータベースから商品のデータをコントローラに渡すことができる。*/
Route::post('products/{product}/reviews', 'ReviewController@store');

//お気に入り機能実装。
Route::get('products/{product}/favorite', 'ProductController@favorite')->name('products.favorite');
/*Route::resourceを使うことで、CRUD用のURLを一度に定義することができる。
第一引数にベースとなるURLを文字列で渡し、第二引数で使用するコントローラを指定する。*/
Route::resource('products', 'ProductController');
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
