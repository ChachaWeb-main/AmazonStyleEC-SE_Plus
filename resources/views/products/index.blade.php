@extends('layouts.app')

@section('content')

<div class="row">
    {{-- サイドバーをコンポーネントとして呼び出し,呼び出すコンポーネント名の後に連想配列を作成することで、コンポーネントへと変数を渡すことができる--}}
    <div class="col-2">
        @component('components.sidebar', ['categories' => $categories, 'major_category_names' => $major_category_names])
        @endcomponent
    </div>
    <div class="col-9">
        {{--カテゴリで絞り込みができた際に、どういうカテゴリの商品が表示されているのかが分かるように、
            $categoryは、受け取ってきた値をもとに取得したカテゴリの値が保存されている変数--}}
        <div class="container">
            {{--@if ($category !== null)を使い、値を受け取っていない時にエラーになることを回避--}}
            @if ($category !== null)
                <a href="/">トップ</a> > <a href="#">{{ $category->major_category_name }}</a> > {{ $category->name }}
                {{--$total_countでは、カテゴリで絞り込んだ商品の数を表示--}}
                <h1>{{ $category->name }}の商品一覧{{$total_count}}件</h1>
            @endif
        </div>
        <div class="container mt-4">
            <div class="row w-100">
                @foreach($products as $product)
                <div class="col-3">
                    <a href="{{route('products.show', $product)}}">
                        <img src="{{ asset('img/book.jpg')}}" class="img-thumbnail">
                    </a>
                    <div class="row">
                        <div class="col-12">
                            <p class="mymazon-product-label mt-2">
                                {{$product->name}}<br>
                                <label>￥{{$product->price}}</label>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        {{--ページネーション(カテゴリで絞り込んだ条件を保持してページング)--}}
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>
@endsection