<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\Oder;
use App\Models\OderDetail;
use Psy\Readline\Hoa\Console;

class BuyController extends Controller
{
    /* ===購入=== */
    // 購入確認ページへの遷移
    public function buy_confirm(Request $request) {
        $sesdata = $request->session()->get('cart');
        if(empty($sesdata)) {
            return redirect()->action([ProductController::class, 'index']);
        }
        // 値の有無
        $address_flag = true;
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
        $user_id = Auth::user()->id;
        $items = Address::where('user_id', '=', Auth::user()->id)->first();
        if(!empty($items)) {
            $address_flag = false;
        }

        return view('user.product_buy_confirm',[
            // カート内の商品データ
            'sesdata' => $sesdata, 
            // 合計金額
            'price_sum' => $price_sum, 
            // 個数
            'quantity_sum' => $quantity_sum, 
            // カートデータフラグ
            'null_flag' => $null_flag, 
            // アドレスデータフラグ
            'address_flag' => $address_flag,
            // address
            'address' => $items,
            // user_id
            'user_id' => $user_id
        ]);
    }

    // 購入処理
    public function buy(Request $request) {
        $sesdata = $request->session()->get('cart');
        // request
        //お届け先
        $name = $request['name'];
        $telephone_number = $request['telephone_number'];
        $post_code = $request['post_code'];
        $prefectures = $request['prefectures'];
        $municipalities = $request['municipalities'];
        $street_address = $request['street_address'];
        $building = $request['building'];
        $address_flag = $request['address_flag'];
        $address_id = $request['address_id'];
        //支払方法
        $payment_method = $request['payment_method'];
        //合計金額
        $price_sum = $request['price_sum'];
        //user_id
        $user_id = $request['user_id'];

        //変数定義
        $address_in_id = 0;

        // お届け先テーブルに登録
        if(!$address_flag) {
            $address = Address::find($address_id);
            $address -> update([
                "name" => $name,
                "telephone_number" => $telephone_number,
                "post_code" => $post_code,
                "prefectures" => $prefectures,
                "municipalities" => $municipalities,
                "street_address" => $street_address,
                "building" => $building,
            ]);
            $address_in_id = $address_id;
            print('住所あり');
        } else {            
            $address = new Address();
            $address -> fill([
                "user_id" => $user_id,
                "name" => $name,
                "telephone_number" => $telephone_number,
                "post_code" => $post_code,
                "prefectures" => $prefectures,
                "municipalities" => $municipalities,
                "street_address" => $street_address,
                "building" => $building,
            ]);
            $address->save();
            $address_in_id = $address->id; 
        }

        // 注文テーブルに登録
        $oder = new Oder();
        $oder -> fill([
            "user_id" => $user_id,
            "address_id" => $address_in_id,
            "payment_method" => $payment_method,
            "total_amount" => $price_sum,
        ]);
        $oder->save();
        $oder_in_id = $oder->id; 

        // 注文詳細テーブルの作成
        foreach($sesdata as $key => $value) {
            $oder_detail = new OderDetail();
            $oder_detail -> fill([
                "oder_id" => $oder_in_id,
                "product_id" => $value['id'],
                "name" => $value['name'],
                "quantity" => $value['quantity'],
                "price" => $value['price'],
            ]);
            $oder_detail->save();
        }

        // sessionの削除
        $request->session()->forget('cart');

        return redirect()->action([ProductController::class, 'index']);
    }
}
