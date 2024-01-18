<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request) {
        $items = Product::all();
        return view('user_home', ['items' => $items]);
    }
}