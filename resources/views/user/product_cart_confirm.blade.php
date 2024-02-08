@extends('layouts.user')

@section('title', 'カートに商品を入れる')

@section('content')
    <p>カートに商品を追加しました。</p>
    <p>{{$data['name']}} 金額:{{$data['price']}}</p>
    <button type="button" onClick="history.back()">戻る</button>
@endsection