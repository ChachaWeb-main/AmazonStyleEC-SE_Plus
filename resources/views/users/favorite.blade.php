@extends('layouts.app')

@section('content')
<div class="container  d-flex justify-content-center mt-3">
    <div class="w-75">
        <h1>お気に入り</h1>

        <hr>

        <div class="row">
            @foreach ($favorites as $fav)
            <div class="col-md-8 mt-2">
                <div class="d-inline-flex">
                    <a href="{{route('products.show', $fav)}}" class="w-25">
                        <img src="{{ asset('img/book.jpg')}}" class="img-fuild w-100">
                    </a>
                    <div class="container mt-3">
                        <h5 class="w-100 mymazon-favorite-item-text">{{App\Product::find($fav->favoriteable_id)->name}}</h5>
                        <h6 class="w-100 mymazon-favorite-item-text">￥{{App\Product::find($fav->favoriteable_id)->price}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-2 d-flex align-items-center justify-content-end">
                <a href="/products/{{ $fav->id }}/favorite" class="mymazon-favorite-item-delete">
                    削除
                </a>
            </div>
            <div class="col-md-2 d-flex align-items-center justify-content-end">
                <button type="submit" class="btn mymazon-favorite-add-cart text-white w-100">カートに入れる</button>
            </div>
            @endforeach
        </div>

        <hr>
    </div>
</div>
@endsection