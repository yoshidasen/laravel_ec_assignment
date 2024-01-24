@extends('layouts.user')

@section('title', 'user_search')

@section('content')
    user_hello search

    user_hello
    <style>
        #container {
            display: flex; /* flexbox */
            flex-wrap: wrap; /* 折返し指定 */
        }

        #container div {
            width: 25%;
        }
    </style>

    <form action="/user/product_search" method="post">
        @csrf
        検索<input type="text" name="name" value="">
        <input type="submit" value="検索">
    </form>


    <div id="container">
    @foreach ($items as $item)
        <div>
            <a href="/user/product_detail/{{$item->id}}" style="text-decoration: none; color: black;">
                <div style="margin: 0 auto; width: 200px;">
                    <div style="width: 200px; height: 250px; background-color: darksalmon;"></div>
                    <p>{{$item->name}}</p>
                    <p style="text-align: right;">{{$item->price}}</p>
                </div>
            </a>
        </div>
    @endforeach
    </div>
@endsection