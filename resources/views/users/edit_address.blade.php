@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <span>
                <a href="{{ route('mypage') }}">マイページ</a> > お届け先変更
            </span>
            <h3 class="mt-3 mb-3">お届け先変更</h3>

            <hr>

            <form method="POST" action="/users/mypage">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group row">
                    <label for="name" class="col-md-5 col-form-label text-md-left">氏名<span class="ml-1 mymazon-require-input-label"><span class="mymazon-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror mymazon-login-input" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="侍 太郎">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>氏名を入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-5 col-form-label text-md-left">郵便番号<span class="ml-1 mymazon-require-input-label"><span class="mymazon-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input type="text" class="form-control @error('postal_code') is-invalid @enderror mymazon-login-input" name="postal_code" value="{{ $user->postal_code }}" required placeholder="150-0043">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-5 col-form-label text-md-left">住所<span class="ml-1 mymazon-require-input-label"><span class="mymazon-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input type="text" class="form-control @error('address') is-invalid @enderror mymazon-login-input" name="address" value="{{ $user->address }}" required placeholder="東京都渋谷区道玄坂２丁目１１−１">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-5 col-form-label text-md-left">電話番号<span class="ml-1 mymazon-require-input-label"><span class="mymazon-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input type="text" class="form-control @error('phone') is-invalid @enderror mymazon-login-input" name="phone" value="{{ $user->phone }}" required placeholder="03-5790-9039">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-5 col-form-label text-md-left">メールアドレス<span class="ml-1 mymazon-require-input-label"><span class="mymazon-require-input-label-text">必須</span></span></label>

                    <div class="col-md-7">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror mymazon-login-input" name="email" value="{{ $user->email }}" required autocomplete="email" placeholder="samurai@samurai.com">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>メールアドレスを入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <hr>

                <div class="form-group d-flex justify-content-end">
                    <button type="submit" class="btn mymazon-submit-button w-25">
                        保存する
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection