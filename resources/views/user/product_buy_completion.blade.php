@extends('layouts.user')

@section('title', '購入完了')

@section('content')
    <p>購入完了いたしました。</p>
    <p>支払方法：{{ $payment_method }}</p>
    <p>購入金額：{{ $price_sum }}</p>
    <a href="/user_home">ホームに戻る</a>
@endsection