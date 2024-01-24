<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

use DB;


class ProductController extends Controller
{
    // 一覧表示
    public function index(Request $request) {
        $items = Product::deleteFlag($request->input)->releaseFlag($request->input)->get();
        // $items = Product::where('delete_flag' )
        return view('user_home', ['items' => $items]);
    }

    // 商品詳細表示
    public function find($id) {
        $items = Product::find($id);
        return view('user.product_detail', ['items' => $items]);
    }

    // 商品検索
    public function search_get(Request $request) {
        return view('user.product_search', ['input' => $request]);
    }

    
    public function search(Request $request) {
        // 確認したいSQLの前にこれを仕込んで
        // DB::enableQueryLog();

        $key = $request['name']; 
        // $key = $request->name;
        $items = Product::deleteFlag($request->input)->releaseFlag($request->input)->where('name', 'LIKE', '%'.$key.'%')->get();

        // dumpする
        // dd(DB::getQueryLog(), $request, $key);

        $param = ['input' => $request->input, 'items' => $items];
        return view('user.product_search', $param);
    }
}
