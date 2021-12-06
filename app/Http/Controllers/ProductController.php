<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Support\Facades\Auth; //お気に入り機能実装
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    // 作成されたすべての商品を表示
    public function index(Request $request) //Request $requestを追加し,これにより渡された値を、アクション内で使用することができるようになる。
    {
        //ソートを行う処理
        $sort_query = [];
        $sorted = "";
        
        if ($request->direction !== null) {
            $sort_query = $request->direction;
            $sorted = $request->sort;
        } else if ($request->sort !== null) {
            $slices = explode(' ', $request->sort);
            $sort_query[$slices[0]] = $slices[1];
            $sorted = $request->sort;
        }
        
        if ($request->category !== null) {
            $products = Product::where('category_id', $request->category)->sortable($sort_query)->paginate(15); //受け取った絞り込みたいカテゴリのIDを持つ商品データを取得し、ページネーションも実行。
            $total_count = Product::where('category_id', $request->category)->count(); //当該カテゴリの商品数を表示。
            $category = Category::find($request->category);
        } else {
            $products = Product::sortable($sort_query)->paginate(15);
            $total_count = "";
            $category = null;
        }
        
        $sort = [
            '並び替え' => '', 
            '価格の安い順' => 'price asc',
            '価格の高い順' => 'price desc', 
            '出品の古い順' => 'updated_at asc', 
            '出品の新しい順' => 'updated_at desc'
        ];
        
        $categories = Category::all(); //全カテゴリーを$categotiesに代入
        $major_category_names = Category::pluck('major_category_name')->unique(); /*全カテゴリのデータからmajor_category_nameのカラムのみを取得し,
                                                                                    そのうえでuniq()を使い、重複している部分を削除。*/
        return view('products.index', compact('products', 'category', 'categories', 'major_category_names', 'total_count', 'sort', 'sorted')); //compact関数で、ビューに渡される。
    }
    
    // お気に入り機能実装
    public function favorite(Product $product)
    {
        $user = Auth::user(); //現在のユーザーの情報を$user変数に代入
        
        /*$user->hasFavorited($product)で、ユーザーがその商品をお気に入り済みかどうかをチェック。
          お気に入り済みであれば、お気に入りを外す*/
        if ($user->hasFavorited($product)) {
            $user->unfavorite($product);
        } else {
            $user->favorite($product);
        }
        
        return redirect()->route('products.show', $product); //商品の個別ページへリターン
    }
    
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $reviews = $product->reviews()->get(); //商品についての全てのレビューを取得して、$reviewsに保存
        
        return view('products.show', compact('product', 'reviews')); //取得したレビューをcompact関数でビューへ渡す
    }
    
}
