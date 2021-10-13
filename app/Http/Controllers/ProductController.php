<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    // 作成されたすべての商品を表示
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products')); //compact関数で、変数$productsがビューに渡される。
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
