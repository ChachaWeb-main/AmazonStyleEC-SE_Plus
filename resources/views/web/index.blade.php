@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-2">
        @component('components.sidebar', ['categories' => $categories, 'major_category_names' => $major_category_names])
        @endcomponent
    </div>
    <div class="col-9">
        <h1 class="web-index-item">おすすめ商品</h1>
        {{-- おすすめの商品を表示 --}}
        <div class="row">
            @foreach ($recommend_products as $recommend_product)
            <div class="col-4">
                <a href="/products/{{ $recommend_product->id }}">
                    @if ($recommend_product->image !== "")
                    <img src="{{ asset('storage/products/'.$recommend_product->image) }}" class="img-thumbnail">
                    @else
                    <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
                    @endif
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="mymazon-product-label mt-2">
                            {{ $recommend_product->name }}<br>
                            <label>￥{{ $recommend_product->price }}</label>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <h1 class="web-index-item">新着商品</h1>
        <div class="row">
            {{-- app/Http/Controllers/WebController.phpのindexアクションで取得した新着商品を表示 --}}
            @foreach ($recently_products as $recently_product)
            <div class="col-3">
                <a href="/products/{{ $recently_product->id }}">
                    <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="mymazon-product-label mt-2">
                            {{ $recently_product->name }}<br>
                            <label>￥{{ $recently_product->price }}</label>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection