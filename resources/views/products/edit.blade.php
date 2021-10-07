<h1>Update Products</h1>

<form method="POST" action="/products/{{ $product->id }}">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT"> <!--LaravelではPUTでリクエストを送ることでデータを更新できる-->
    <input type="text" name="name" value="{{ $product->name }}"> <!--value="{{ $product->name }}"のように初期値に既存の商品のデータを使用-->
    <textarea name="description">{{ $product->description }}</textarea>
    <input type="number" name="price"  value="{{ $product->price }}">
    <select name="category_id">
        @foreach ($categories as $category)
            <!--商品に登録されているカテゴリ名をデフォルトで表示するように、
            selectedを追加することで登録済みの商品のカテゴリ名を表示することができる。-->
            @if ($category->id == $product->category_id)
                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
            @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
        @endforeach
    </select>
    <button type="submit">Update</button>
</form>

<a href="/products">Back</a>