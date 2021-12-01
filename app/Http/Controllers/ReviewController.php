<?php

//レビューの投稿のみを行うため、storeアクション以外のアクションは全て削除

namespace App\Http\Controllers;

use App\Review;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
    /* レビューが作成される商品のデータを、変数$productとして受け取っている。
    紐づけを使い、$review = new Review();で新しいレビューのデータを作成。
    あとは$request内のデータをレビューの各カラムに保存。
    レビューを作成したユーザーのIDは、Auth::user()->idにてレビューに保存。
    これはコントローラーの先頭に追加したuse Illuminate\Support\Facades\Auth;で、
    現在レビューをしているユーザーの情報をReviewController.phpで取り扱えるようにしているおかげ。*/
    
    public function store(Product $product, Request $request)
    {
        $review = new Review();
        $review->content = $request->input('content');
        $review->product_id = $product->id;
        $review->user_id = Auth::user()->id;
        $review->score = $request->input('score'); //フォームから送信された評価をデータベースに保存。
        $review->save();

        return redirect()->route('products.show', $product);
    }

}
