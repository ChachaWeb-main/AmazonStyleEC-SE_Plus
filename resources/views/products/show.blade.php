@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
    <div class="row w-75">
        <div class="col-5 offset-1">
            <img src="{{ asset('img/dummy.png')}}" class="w-100 img-fuild">
        </div>
        <div class="col">
            <div class="d-flex flex-column">
                <h1 class="">
                    {{$product->name}}
                </h1>
                <p class="">
                    {{$product->description}}
                </p>
                <hr>
                <p class="d-flex align-items-end">
                    ￥{{$product->price}}(税込)
                </p>
                <hr>
            </div>
            @auth
            <form method="POST" class="m-3 align-items-end">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$product->id}}">
                <input type="hidden" name="name" value="{{$product->name}}">
                <input type="hidden" name="price" value="{{$product->price}}">
                <div class="form-group row">
                    <label for="quantity" class="col-sm-2 col-form-label">数量</label>
                    <div class="col-sm-10">
                        <input type="number" id="quantity" name="qty" min="1" value="1" class="form-control w-25">
                    </div>
                </div>
                <input type="hidden" name="weight" value="0">
                <div class="row">
                    <div class="col-7">
                        <button type="submit" class="btn samazon-submit-button w-100">
                            <i class="fas fa-shopping-cart"></i>
                            カートに追加
                        </button>
                    </div>
                    <div class="col-5">
                        <a href="/products/{{ $product->id }}/favorite" class="btn samazon-favorite-button text-dark w-100">
                            <i class="fa fa-heart"></i>
                            お気に入り
                        </a>
                    </div>
                </div>
            </form>
            @endauth
        </div>

        <div class="offset-1 col-11">
            <hr class="w-100">
            <h3 class="float-left">カスタマーレビュー</h3>
        </div>

        <div class="offset-1 col-10">
            <!-- レビューを実装する箇所になります -->
        </div>
    </div>
</div>
@endsection