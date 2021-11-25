<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class WebController extends Controller
{
    public function index()
    {
        $categories = Category::all()->sortBy('major_category_name');
        
        $major_category_names = Category::pluck('major_category_name')->unique();
        
        return view('web.index', compact('major_category_names', 'categories'));
    }
}
