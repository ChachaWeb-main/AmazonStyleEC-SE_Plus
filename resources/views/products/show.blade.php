@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
    <div class="row w-75">
        <div class="col-5 offset-1">
            @if ($product->image !== null)
            <img src="{{ asset('storage/products/'.$product->image) }}" class="w-100 img-fluid">
            @else
            <img src="{{ asset('img/dummy.png')}}" class="w-100 img-fuild">
            @endif
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
            {{--カートに商品を追加できるように。--}}
            <form method="POST" action="{{route('carts.store')}}" class="m-3 align-items-end">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$product->id}}">
                <input type="hidden" name="name" value="{{$product->name}}">
                <input type="hidden" name="price" value="{{$product->price}}">
                {{-- カートに送料の有無を保存できるように、carriage_flagカラムの値をコントローラに送信する。 --}}
                <input type="hidden" name="carriage" value="{{$product->carriage_flag}}">
                <div class="form-group row">
                    <label for="quantity" class="col-sm-2 col-form-label">数量</label>
                    <div class="col-sm-10">
                        <input type="number" id="quantity" name="qty" min="1" value="1" class="form-control w-25">
                    </div>
                </div>
                <input type="hidden" name="weight" value="0">
                <div class="row">
                    <div class="col-7">
                        <button type="submit" class="btn mymazon-submit-button w-100">
                            <i class="fas fa-shopping-cart"></i>
                            カートに追加
                        </button>
                    </div>
                    <div class="col-5">
                        {{-- お気に入り機能の実装 --}}
                        @if($product->isFavoritedBy(Auth::user()))
                        <a href="/products/{{ $product->id }}/favorite" class="btn mymazon-favorite-button text-favorite text-danger w-110">
                            <i class="heart fa fa-heart"></i>
                            お気に入り解除
                        </a>
                        @else
                        <a href="/products/{{ $product->id }}/favorite" class="btn mymazon-favorite-button text-favorite text-danger w-110">
                            <i class="heart fa fa-heart"></i>
                            お気に入り
                        </a>
                        @endif
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
            {{-- レビューを実装箇所 --}}
            <div class="row">
                {{-- その商品に関しての全てのレビューが$reviewsに保存されており、foreach を使うことで全てのレビューを表示させる --}}
                @foreach($reviews as $review)
                <div class="offset-md-5 col-md-5">
                    {{-- 保存されたレビューの評価を表示 --}}
                    <h3 class="review-score-color">{{ str_repeat('★', $review->score) }}</h3>
                    <p class="h3">{{$review->content}}</p>
                    {{-- レビューをしたユーザーの名前を表示 --}}
                    <h4>{{$review->user->name}}</h4>
                    <label>{{$review->created_at}}</label>
                    <br>
                    <br>
                </div>
                @endforeach
            </div>
            {{-- ログイン済みかどうかを判定できる auth を使うことでログインしている状態でのみレビュー用のフォームが画面に表示される --}}
            @auth
            <div class="row">
                <div class="offset-md-5 col-md-5">
                    <form method="POST" action="/products/{{ $product->id }}/reviews">
                        {{ csrf_field() }}
                        {{-- レビュー星 評価項目 --}}
                        <h4>評価</h4>
                        <select name="score" class="form-control m-2 review-score-color">
                            <option value="5" class="review-score-color">★★★★★</option>
                            <option value="4" class="review-score-color">★★★★</option>
                            <option value="3" class="review-score-color">★★★</option>
                            <option value="2" class="review-score-color">★★</option>
                            <option value="1" class="review-score-color">★</option>
                        </select>
                        <h4>レビュー内容</h4>
                        <textarea name="content" class="form-control m-2"></textarea>
                        <button type="submit" class="btn mymazon-submit-button ml-2">レビューを追加</button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>
@endsection