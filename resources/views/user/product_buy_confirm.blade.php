@extends('layouts.user')

@section('title', '購入内容')

@section('content')
    <h2>購入内容</h2>
    <style>
        table, th, td {
            text-align: center;
            border-collapse: collapse;
            border: 2px solid lightblue;
        }
        th, td {
            padding: 5px 10px;
        }
    </style>
    <table>
        <tr>
            <th>商品名</th>
            <th>数量</th>
            <th>金額</th>
            <th>小計</th>
            <th></th>
        </tr>
    @if($null_flag)
        @foreach($sesdata as $key => $value)
            <tr>
                <td>{{$value['name']}}</td>
                <td>{{$value['quantity']}}</td>
                <td>{{$value['price']}}</td>
                <td>{{$value['subtotal']}}</td>
                <td><a href="/user/product_cart_delete/{{$key}}">削除</a></td>
            </tr>
        @endforeach
    @endif
    </table>
    <p>数量：{{$quantity_sum}}　　合計金額：{{$price_sum}}</p>

    <form action="/user/product_buy_completion" method="post">
        @csrf
        @if(!$address_flag)
            <h2>お客様情報の入力</h2>
            名前：<input type="text" name="name" placeholder="例)田中花子" require value="{{$address->name}}"><br>
            電話番号：<input type="tel" name="telephone_number" placeholder="例)01234567890" required value="{{$address['telephone_number']}}"><br>
            <h2>住所の入力</h2>
            郵便番号：<input type="text" name="post_code" placeholder="例)0123456" required value="{{$address['post_code']}}"><br>
            都道府県：<input type="text" name="prefectures" placeholder="例)岩手県" required value="{{$address['prefectures']}}"><br>
            市区町村：<input type="text" name="municipalities" placeholder="例)盛岡市" required value="{{$address['municipalities']}}"><br>
            番地：<input type="text" name="street_address" placeholder="例)0-1-2" require value="{{$address['street_address']}}"><br>
            建物・部屋番号：<input type="text" name="building" placeholder="例)モリジョビ 302" value="{{$address['building']}}"><br>
            <input type="hidden" name="address_id" value="{{$address['id']}}">
        @else
            <h2>お客様情報の入力</h2>
            名前：<input type="text" name="name" placeholder="例)田中花子" require><br>
            電話番号：<input type="tel" name="telephone_number" placeholder="例)01234567890" required><br>
            <h2>住所の入力</h2>
            郵便番号：<input type="text" name="post_code" placeholder="例)0123456" required><br>
            都道府県：<input type="text" name="prefectures" placeholder="例)岩手県" required><br>
            市区町村：<input type="text" name="municipalities" placeholder="例)盛岡市" required><br>
            番地：<input type="text" name="street_address" placeholder="例)0-1-2" require><br>
            建物・部屋番号：<input type="text" name="building" placeholder="例)モリジョビ 302"><br>
            <input type="hidden" name="address_id" value="null">
        @endif

        <h2>支払方法の選択</h2>
        <input type="radio" id="bank_transfer" name="payment_method" value="bank_transfer">
        <label for="bank_transfer">銀行振り込み</label><br>
        <input type="radio" id="card" name="payment_method" value="card">
        <label for="card">カード決済</label><br>

        <input type="hidden" name="address_flag" value="{{$address_flag}}">
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <input type="hidden" name="price_sum" value="{{$price_sum}}">

        <input type="submit" value="購入する">
    </form>
    
    <button type="button" onClick="history.back()">戻る</button>
@endsection