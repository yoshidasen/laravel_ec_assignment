<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function index(Request $request) {
        $items = Category::all();
        return view('user_home', ['items' => $items]);
    }
    
}
