{{-- 売上一覧画面 --}}
@extends('layouts.dashboard')

@section('content')

<div class="w-75">
 
    @if($sort == 'month')
        <h1>月別売上 {{ $total }} 件</h1>
    @else
        <h1>日別売上 {{ $total }} 件</h1>
    @endif
    
    <form method="GET" action="/dashboard" class="form-inline">
        切り替え
        <select name="sort" onChange="this.form.submit();" class="form-inline ml-2">
            @if ($sort == 'month')
                <option value="month" selected>月別</option>
                <option value="day">日別</option>
            @else
                <option value="month">月別</option>
                <option value="day" selected>日別</option>
            @endif
        </select>
    </form>
    
    <div class="container mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">年月日</th>
                    <th scope="col">金額</th>
                    <th scope="col">件数</th>
                    <th scope="col">平均単価</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paginator as $billing)
                <tr>
                    <td>{{ $billing['created_at']}}</td>
                    <td>{{ $billing['total']}}</td>
                    <td>{{ $billing['count']}}</td>
                    <td>{{ $billing['avg']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    {{ $paginator->links() }}
</div>
 

@endsection 