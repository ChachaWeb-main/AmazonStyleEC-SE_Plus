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
        if ($request->category !== null) {
            $products = Product::where('category_id', $request->category)->paginate(15); //受け取った絞り込みたいカテゴリのIDを持つ商品データを取得し、ページネーションも実行。
            $total_count = Product::where('category_id', $request->category)->count(); //当該カテゴリの商品数を表示。
            $category = Category::find($request->category);
        } else {
            $products = Product::paginate(15);
            $total_count = "";
            $category = null;
        }
        
        $categories = Category::all(); //全カテゴリーを$categotiesに代入
        $major_category_names = Category::pluck('major_category_name')->unique(); /*全カテゴリのデータからmajor_category_nameのカラムのみを取得し,
                                                                                    そのうえでuniq()を使い、重複している部分を削除。*/

        return view('products.index', compact('products', 'category', 'categories', 'major_category_names', 'total_count')); //compact関数で、ビューに渡される。
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    //  新しく作成する商品データを入力する入力フォームを表示させる
    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    //データを受け取り、新しいデータを保存するアクション
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id'); //新規で商品登録する際にカテゴリを選択でき、保存も可
        $product->save();
        
        // storeなどのアクションではviewを持たないため、この処理を書き忘れると真っ白な画面のままということになる。
        return redirect()->route('products.show', ['id' => $product->id]);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
     
    //編集する商品のデータをビューへと渡す
    public function edit(Product $product)
    {
        //カテゴリの全データが入っている$categories変数をビューに
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories')); //compact関数では,で区切ることで複数の変数を渡すことができるので非常に便利
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    
    /*更新前の商品のデータは$product変数に渡されている。
    それを元に、$request内に格納されているフォームに入力した更新後のデータをそれぞれのカラムに渡して上書きしている*/
    public function update(Request $request, Product $product)
    {
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->update();

        return redirect()->route('products.show', ['id' => $product->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    
    /*リクエストを受け付けてデータを削除する
    そのためdestroyアクション内には、データベース内の指定のデータを削除する処理と、削除後のリダイレクト処理が必要*/
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
