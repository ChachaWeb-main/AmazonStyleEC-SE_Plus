<h1>New Products</h1>

<form method="POST" action="/products">
    {{ csrf_field() }}　<!--CSRF対策にトークンを自動的に作成し、そのトークンを持つリクエスト以外は弾く-->
    <input type="text" name="name">
    <textarea name="description"></textarea>
    <input type="number" name="price">
    <select name="category_id">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <button type="submit">Create</button>
</form>

<a href="/products">Back</a>