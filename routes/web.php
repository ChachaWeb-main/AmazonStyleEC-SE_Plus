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

Route::get('/', 'WebController@index'); //トップページ

Route::get('users/carts', 'CartController@index')->name('carts.index'); //カートの中身を確認するページ。

Route::post('users/carts', 'CartController@store')->name('carts.store'); //カート追加する。

Route::delete('users/carts', 'CartController@destroy')->name('carts.destroy'); //カート内の商品を購入。

// ユーザー情報関連の各ルーティングを設定。
Route::get('users/mypage', 'UserController@mypage')->name('mypage');
Route::get('users/mypage/edit', 'UserController@edit')->name('mypage.edit');
Route::get('users/mypage/address/edit', 'UserController@edit_address')->name('mypage.edit_address'); //登録住所変更。
Route::put('users/mypage', 'UserController@update')->name('mypage.update');
Route::get('users/mypage/favorite', 'UserController@favorite')->name('mypage.favorite'); //お気に入りした商品表示。
Route::get('users/mypage/password/edit', 'UserController@edit_password')->name('mypage.edit_password'); //パスワード変更。
Route::put('users/mypage/password', 'UserController@update_password')->name('mypage.update_password');

/* レビューの内容をデータとしてフォームから送信する必要があるため、Route::postでPOSTで使用するルーティングだと分かるようにコードを。
また、商品のデータを自動的に取得するために、URLをproducts/{product}/reviewsとして、
最後に、使用するコントローラーとそのアクションを、ReviewController@storeと指定。
この設定で、商品のIDを元に自動的にデータベースから商品のデータをコントローラに渡すことができる。*/
Route::post('products/{product}/reviews', 'ReviewController@store');

//お気に入り機能実装。
Route::get('products/{product}/favorite', 'ProductController@favorite')->name('products.favorite');

// 商品の管理画面
Route::get('products', 'ProductController@index')->name('products.index');
Route::get('products/{product}', 'ProductController@show')->name('products.show');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

// ログインした管理者以外のアクセスを弾くように。
Route::get('/dashboard', 'DashboardController@index')->middleware('auth:admins');

// 管理者画面
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::get('login', 'Dashboard\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Dashboard\Auth\LoginController@login')->name('login');
    Route::resource('major_categories', 'Dashboard\MajorCategoryController')->middleware('auth:admins'); //親カテゴリ(major)
    Route::resource('categories', 'Dashboard\CategoryController')->middleware('auth:admins'); //カテゴリ
    Route::resource('products', 'Dashboard\ProductController')->middleware('auth:admins'); // 商品
});

// APP_ENVという環境変数を使い、自動的に本番環境か開発環境かをLaravel側で判断し、どちらでも動作するように修正。
if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}