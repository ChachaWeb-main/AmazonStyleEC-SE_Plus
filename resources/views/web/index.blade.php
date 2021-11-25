@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-2">
        @component('components.sidebar', ['categories' => $categories, 'major_category_names' => $major_category_names])
        @endcomponent
    </div>
    <div class="col-9">
        <h1 class="web-index-item">おすすめ商品</h1>
        <div class="row">
            <div class="col-4">
                <a href="#">
                    <img src="{{ asset('img/orange.png') }}" class="img-thumbnail">
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="mymazon-product-label mt-2">
                            旬のオレンジ詰め合わせ<br>
                            <label>￥2,000</label>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <a href="#">
                    <img src="{{ asset('img/pan.png')}}" class="img-thumbnail">
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="mymazon-product-label mt-2">
                            フライパン20cm 鉄製 業務用<br>
                            <label>￥5,000</label>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-4">
                <a href="#">
                    <img src="{{ asset('img/meat.png')}}" class="img-thumbnail">
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="mymazon-product-label mt-2">
                            和牛ロース200g 2枚入り<br>
                            <label>￥8,200</label>
                        </p>
                    </div>
                </div>
            </div>
            
        </div>
        
        <h1 class="web-index-item">新着商品</h1>
        <div class="row">
            <div class="col-3">
                <a href="#">
                    <img src="{{ asset('img/panasonic.png')}}" class="img-thumbnail">
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="mymazon-product-label mt-2">
                            掃除機本体 Panasonic<br>
                            <label>￥15,000</label>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-3">
                <a href="#">
                    <img src="{{ asset('img/sofa.png')}}" class="img-thumbnail">
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="mymazon-product-label mt-2">
                            3人掛けソファー ブラウン<br>
                            <label>￥35,000</label>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-3">
                <a href="#">
                    <img src="{{ asset('img/item.png')}}" class="img-thumbnail">
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="mymazon-product-label mt-2">
                            柔軟剤 詰め替え 2L<br>
                            <label>￥1,000</labiel>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-3">
                <a href="#">
                    <img src="{{ asset('img/goods.png')}}" class="img-thumbnail">
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="mymazon-product-label mt-2">
                            食器 カトラリーセット1組<br>
                            <label>￥2,000</label>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection