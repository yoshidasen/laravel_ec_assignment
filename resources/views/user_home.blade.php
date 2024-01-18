@extends('layouts.user')

@section('title', 'top')

@section('content')
    user_hello


    <table style="border: 1px solid #000;">
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
    </table>
@endsection