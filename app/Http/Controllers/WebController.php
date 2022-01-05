<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product; //追加

class WebController extends Controller
{
    public function index()
    {
        $categories = Category::all()->sortBy('major_category_name');
        
        $major_category_names = Category::pluck('major_category_name')->unique();
        
        //新規追加された商品を取得する。 
        $recently_products = Product::orderBy('created_at', 'desc')->take(4)->get();
        // おすすめの商品を取得する。
        $recommend_products = Product::where('recommend_flag', true)->take(3)->get();
        
        return view('web.index', compact('major_category_names', 'categories', 'recently_products', 'recommend_products'));
    }
}