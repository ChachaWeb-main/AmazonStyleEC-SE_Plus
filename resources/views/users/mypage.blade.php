@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-3">
    <div class="w-50">
        <h1>マイページ</h1>

        <hr>

        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="row">
                    <div class="col-2 d-flex align-items-center">
                        <i class="myp-icon fas fa-user fa-3x"></i>
                    </div>
                    <div class="col-9 d-flex align-items-center ml-2 mt-3">
                        <div class="d-flex flex-column">
                            <label class="mypage-item" for="user-name">会員情報の編集</label>
                            <p>ーアカウント情報の編集ー</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{route('mypage.edit')}}">
                        <i class="fas fa-chevron-right fa-2x"></i>
                    </a>
                </div>
            </div>
        </div>

        <hr>

        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="row">
                    <div class="col-2 d-flex align-items-center">
                        <i class="myp-icon fas fa-archive fa-3x"></i>
                    </div>
                    <div class="col-9 d-flex align-items-center ml-2 mt-3">
                        <div class="d-flex flex-column">
                            <label class="mypage-item" for="user-name">注文履歴</label>
                            <p>ー注文履歴を確認できますー</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{route('mypage')}}">
                        <i class="fas fa-chevron-right fa-2x"></i>
                    </a>
                </div>
            </div>
        </div>

        <hr>

        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="row">
                    <div class="col-2 d-flex align-items-center">
                        <i class="myp-icon fas fa-map-marked fa-3x"></i>
                    </div>
                    <div class="col-9 d-flex align-items-center ml-3 mt-3">
                        <div class="d-flex flex-column">
                            <label class="mypage-item" for="user-name">お届け先の変更</label>
                            <p>ー登録住所の変更ー</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{route('mypage.edit_address')}}">
                        <i class="fas fa-chevron-right fa-2x"></i>
                    </a>
                </div>
            </div>
        </div>

        <hr>

        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="row">
                    <div class="col-2 d-flex align-items-center">
                        <i class="myp-icon fas fa-sign-out-alt fa-3x"></i>
                    </div>
                    <div class="col-9 d-flex align-items-center ml-2 mt-3">
                        <div class="d-flex flex-column">
                            <label class="mypage-item" for="user-name">ログアウト</label>
                            <p>ーログアウトしますー</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-chevron-right fa-2x"></i>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <hr>
    </div>
</div>
@endsection