{{-- ユーザー一覧を表示するページ --}}
@extends('layouts.dashboard')

@section('content')

<div class="w-75">

    <h1>顧客一覧</h1>
    
    {{-- ユーザー検索機能 --}}
    <div class="w-75">
        <form method="GET" action="{{ route('dashboard.users.index') }}">
            <div class="d-flex flex-inline form-group">
                <div class="d-flex align-items-center">
                   ID・氏名など
                </div>
                <textarea id="search-products" name="keyword" class="form-controll ml-2 w-50">{{$keyword}}</textarea>
            </div>
            <button type="submit" class="btn mymazon-submit-button">検索</button>
        </form>
    </div>

    <table class="table mt-5">
        <thead>
            <tr>
                <th scope="col" class="w-25">ID</th>
                <th scope="col">氏名</th>
                <th scope="col">メールアドレス</th>
                <th scope="col">電話番号</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                    @if ($user->deleted_flag)
                    <form action="/dashboard/users/{{ $user->id }}" method="POST">
                       @csrf
                       <input type="hidden" name="_method" value="DELETE">
                       <button type="submit" class="btn dashboard-delete-link">復帰</button>
                    </form>
                    @else
                    <form action="/dashboard/users/{{ $user->id }}" method="POST">
                       @csrf
                       <input type="hidden" name="_method" value="DELETE">
                       <button type="submit" class="btn dashboard-delete-link">削除</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</div>

@endsection