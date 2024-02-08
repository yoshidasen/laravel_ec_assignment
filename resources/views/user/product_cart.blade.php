@extends('layouts.user')

@section('title', 'カート')

@section('content')
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
    <a href="/user/product_buy_confirm">購入</a>
    <button type="button" onClick="history.back()">戻る</button>
@endsection