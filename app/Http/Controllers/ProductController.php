<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

use DB;
use Faker\Provider\ar_EG\Address;
use Laravel\Ui\Presets\React;
use Termwind\Components\Raw;

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

    /* session */
    // sessionの取得
    public function ses_get(Request $request) {
        $sesdata = $request->session()->get('cart');
        // 値の有無
        $null_flag = true;
        $price_sum = 0;
        $quantity_sum = 0;
        if(isset($sesdata)) {
            // 商品の合計金額・数量の計算
            $price_sum = 0;
            $quantity_sum = 0;
            foreach($sesdata as $key => $value) {
                $price_sum += $value['price'] * $value['quantity'];
                $quantity_sum += $value['quantity'];
            }
        } else {
            $null_flag = false;
        }
        // dd($sesdata);
        return view('user.product_cart',['sesdata' => $sesdata, 'price_sum' => $price_sum, 'quantity_sum' => $quantity_sum, 'null_flag' => $null_flag]);
    }

    // sessionの追加
    public function ses_put(Request $request) {
        // カートに入れられた商品の値の受取
        $id = $request['id'];
        $name = $request['name'];
        $quantity = $request['quantity'];
        $price = $request['price'];
        $subtotal = $quantity * $price;
        // 配列の定義
        $data = array();
        // 配列に代入
        $data = with([
            'id' => $id,
            'name' => $name,
            'quantity' => $quantity,
            'price' => $price,
            'subtotal' => $subtotal,
        ]);

        // 重複フラグの定義
        $duplication_flag = true;
        // 重複した情報のkey
        $duplication_key = 0;
        //sessionから値を取り出す
        $sesdata = $request->session()->get('cart');
        // 重複チェック
        // sessionに値が入っていたらforeachを回す
        if($sesdata != null){
            // 同じ商品が入っていたらflagをfalseにする
            foreach($sesdata as $key => $value) {
                // dd($value['id']);
                if($value['id'] == $id) {
                    $duplication_flag = false;
                    $duplication_key = $key;
                    break;
                }
            }
        }
        //重複してなければsessionに代入
        if($duplication_flag) {
            $request->session()->push('cart', $data);
        } else {
            // sessionの中身を削除
            $request->session()->forget('cart');
            // カートの中身から指定されたものを削除
            unset($sesdata[$duplication_key]);
            // 残った値をセッションに戻す
            // 配列の定義
            $redata = array();
            // 配列に代入
            foreach ($sesdata as $d) {
                $redata = with([
                    'id' => $d['id'],
                    'name' => $d['name'],
                    'quantity' => $d['quantity'],
                    'price' => $d['price'],
                    'subtotal' => $d['subtotal'] * $d['price'],
                ]);
                $request->session()->push('cart', $redata);
                $redata = [];
            }
            $request->session()->push('cart', $data);
        }



        return view('user.product_cart_confirm',['data' => $data]);
    }

    // カート内商品の削除
    public function ses_item_del(Request $request, $key) {
        // セッションに入っているカートの中身の配列を取得
        $sesdata = $request->session()->get('cart');
        // sessionの中身を削除
        $request->session()->forget('cart');
        // カートの中身から指定されたものを削除
        unset($sesdata[$key]);
        // 残った値をセッションに戻す
        // 配列の定義
        $data = array();
        // 配列に代入
        foreach ($sesdata as $d) {
            $data = with([
                'id' => $d['id'],
                'name' => $d['name'],
                'quantity' => $d['quantity'],
                'price' => $d['price'],
                'subtotal' => $d['subtotal'],
            ]);
            $request->session()->push('cart', $data);
            $data = [];
        }
        return redirect()->action([ProductController::class, 'ses_get']);
    }
}
