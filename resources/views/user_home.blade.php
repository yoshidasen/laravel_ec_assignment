@extends('layouts.user')

@section('title', 'top')

@section('content')
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


    <!-- <table style="border: 1px solid #000;">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>category_id</th>
            <th>image</th>
            <th>price</th>
            <th>explanation</th>
            <th>release_flag</th>
            <th>delete_flag</th>
            <th>stock</th>
            <th>create_at</th>
            <th>update_at</th>
        </tr>
        @foreach ($items as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->category->name}}</td>
            <td>{{$item->image}}</td>
            <td>{{$item->price}}</td>
            <td>{{$item->explanation}}</td>
            <td>{{$item->release_flag}}</td>
            <td>{{$item->delete_flag}}</td>
            <td>{{$item->stock}}</td>
            <td>{{$item->create_at}}</td>
            <td>{{$item->update_at}}</td>
        </tr>
        @endforeach 
    </table>-->
@endsection