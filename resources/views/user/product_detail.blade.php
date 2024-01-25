@extends('layouts.user')

@section('title', 'user_datile')

@section('content')
    user_hello
    <p>{{$items->name}}</p>
    <p style="background: gold; width: 80px; text-align: center; border-radius: 10px;">{{$items->category->name}}</p>
    <img src="" alt="{{$items->name}}">
    <p>{{$items->price}}<small>税抜き{{$items->price / 1.1}}</small></p>
    <form action="/user/product_detail/{{$items->id}}" method="post">
        <input type="hidden" name="id" value="{{$items->id}}">
        <input type="hidden" name="name" value="{{$items->name}}">
        <input type="hidden" name="quantity" value="{{$items->quantity}}">
        <input type="hidden" name="price" value="{{$items->price}}">
        <input type="submit" value="カートに入れる">
    </form>
    <p style="white-space:pre-wrap; background: white; padding: 10px;">{{$items->explanation}}</p>


    <button type="button" onClick="history.back()">戻る</button>

    
    <!-- <div id="container">
        <div>
            <a href="/user/product_detals/{{$items->id}}" style="text-decoration: none; color: black;">
                <div style="margin: 0 auto; width: 200px;">
                    <div style="width: 200px; height: 250px; background-color: darksalmon;"></div>
                    <p>{{$items->name}}</p>
                    <p style="text-align: right;">{{$items->price}}</p>
                </div>
            </a>
        </div>
    </div> -->

@endsection