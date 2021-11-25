<div class="container">
    @foreach ($major_category_names as $major_category_name)
        <h2 class="sidebar-category-name">{{ $major_category_name }}</h2>
        @foreach ($categories as $category)
            @if ($category->major_category_name === $major_category_name)
                {{-- {{ route('products.index', ['category' => $category->id]) }}のように、呼び出すルーティングの後に連想配列で変数を渡すことで、コントローラー側へ値を渡すことができる --}}
                <label class="mymazon-sidebar-category-label"><a href="{{ route('products.index', ['category' => $category->id]) }}">{{ $category->name }}</a></label>
            @endif
        @endforeach
    @endforeach
</div>