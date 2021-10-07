@foreach($products as $product)
    {{$product->name}}
    {{$product->description}}
    {{$product->price}}
    <a href="{{route('products.show', $product)}}">Show</a>
    <a href="{{route('products.edit', $product)}}">edit</a> 
    <form action="/products/{{ $product->id }}" method="POST" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit">Delete</button>
    </form> 
@endforeach

{{-- Laravelではrouteヘルパーを使うことで、リンク先のURLを自動的に作成してくれる。
例えばroute('products.create')と記述すれば、/products/createへのリンクを作成してくれる --}}
<a href="{{route('products.create')}}">New</a> 