<?php
// 商品の管理画面で使うコントローラ

namespace App\Http\Controllers\Dashboard;

use App\Product; //追加
use App\Category; //追加
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; //追加 #18
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_query = [];
        $sorted = "";
         
        if ($request->sort !== null) {
            $slices = explode(' ', $request->sort);
            $sort_query[$slices[0]] = $slices[1];
            $sorted = $request->sort;
            }
            
        if ($request->keyword !== null) {
            $keyword = rtrim($request->keyword);
            $total_count = Product::where('name', 'like', "%{$keyword}%")->orwhere('id', "{$keyword}")->count();
            $products = Product::where('name', 'like', "%{$keyword}%")->orwhere('id', "{$keyword}")->sortable($sort_query)->paginate(15);
            } else {
            $keyword = "";
            $total_count = Product::count();
            $products = Product::sortable($sort_query)->paginate(15);
            }
            
        $sort = [
            '価格の安い順' => 'price asc',
            '価格の高い順' => 'price desc',
            '出品の古い順' => 'updated_at asc',
            '出品の新しい順' => 'updated_at desc'
        ];
        
        return view('dashboard.products.index', compact('products', 'sort', 'sorted', 'total_count', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        
        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ],
        [
            'name.required' => '商品名は必須です。',
            'price.required' => '価格は必須です。',
            'description.required' => '商品説明は必須です。',
        ]);
        
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        // おすすめ商品かどうかを判定するフラグを受け取って保存する。
        if ($request->input('recommend') == 'on') {
            $product->recommend_flag = true;
        } else {
            $product->recommend_flag = false;
        }
        // 商品画像をアップロードできるように #18
        if ($request->file('image') !== null) {
            $image = $request->file('image')->store('public/products');
            $product->image = basename($image);
        } else {
            $product->image = '';
        }
        
        // 送料の有無の受け取った値を取得保存する。
        // $request->input('carriage') == 'on'の部分では、送料にチェックが入っているどうかを判定。
        if ($request->input('carriage') == 'on') {
            $product->carriage_flag = true;
        } else {
            $product->carriage_flag = false;
        }
        $product->save();
        
        return redirect()->route('dashboard.products.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ],
        [
            'name.required' => '商品名は必須です。',
            'price.required' => '価格は必須です。',
            'description.required' => '商品説明は必須です。',
        ]);
        
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        // おすすめ商品かどうかを判定するフラグを受け取って保存する。
        if ($request->input('recommend') == 'on') {
            $product->recommend_flag = true;
        } else {
            $product->recommend_flag = false;
        }
        // 商品画像をアップロードできるように #18
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public/products');
            $product->image = basename($image);
        } else if(isset($product->image)) {
            // do nothing
        } else {
            $product->image = '';
        }
        // 既存の商品を編集するときにも、送料の有無を受け取って保存する。
        if ($request->input('carriage') == 'on') {
            $product->carriage_flag = true;
        } else {
            $product->carriage_flag = false;
        }
        $product->update();
        
        return redirect()->route('dashboard.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        
        return redirect()->route('dashboard.products.index');
    }
}
