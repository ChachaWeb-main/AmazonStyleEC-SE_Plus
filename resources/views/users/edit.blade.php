@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <span>
                <a href="{{ route('mypage') }}">マイページ</a> > 会員情報の編集
            </span>
            
            <h1 class="mt-3 mb-3">会員情報の編集</h1>
            
            <hr>
            
            <form method="POST" action="/users/mypage">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="name" class="text-md-left mymazon-edit-user-info-label">氏名</label>
                        <span onclick="switchEditUserInfo('.userName', '.editUserName', '.userNameEditLabel');" class="userNameEditLabel user-edit-label">
                            編集
                        </span>
                    </div>
                    <div class="collapse show userName">
                        <h1 class="mymazon-edit-user-info-value">{{ $user->name }}</h1>
                    </div>
                    <div class="collapse editUserName">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="侍 太郎">
                        
                        <button type="submit" class="btn mymazon-submit-button mt-3 w-25">
                            保存
                        </button>
                        
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>氏名を入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                
                <hr>
                
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="email" class="text-md-left mymazon-edit-user-info-label">メールアドレス</label>
                        <span onclick="switchEditUserInfo('.userMail', '.editUserMail', '.userMailEditLabel');" class="userMailEditLabel user-edit-label">
                            編集
                        </span>
                    </div>
                    <div class="collapse show userMail">
                        <h1 class="mymazon-edit-user-info-value">{{ $user->email }}</h1>
                    </div>
                    <div class="collapse editUserMail">
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus placeholder="samurai@samurai.com">
                        
                        <button type="submit" class="btn mymazon-submit-button mt-3 w-25">
                            保存
                        </button>
                        
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>メールアドレスを入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                
                <hr>
                
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="phone" class="text-md-left mymazon-edit-user-info-label">電話番号</label>
                        <span onclick="switchEditUserInfo('.userPhone', '.editUserPhone', 'userPhoneEditLabel');" class="userPhoneEditLabel user-edit-label">
                            編集
                        </span>
                    </div>
                    <div class="collapse show userPhone">
                        <h1 class="mymazon-edit-user-info-value">{{ $user->phone }}</h1>
                    </div>
                    <div class="collapse editUserPhone">
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="phone" autofocus placeholder="XXX-XXXX-XXXX">
                        
                        <button type="submit" class="btn mymazon-submit-button mt-3 w-25">
                            保存
                        </button>
                        
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>電話番号を入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                
                <hr>
            </form>
            {{-- ユーザー側できる退会フォーム  --}}
            <div class="d-flex justify-content-end">
                <form method="POST" action="{{ route('mypage.destroy') }}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="btn dashboard-delete-link" data-toggle="modal" data-target="#delete-user-confirm-modal">退会する</div>
                    
                    <div class="modal fade" id="delete-user-confirm-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel"><label>本当に退会しますか？</label></h5>
                                    {{-- 誤って退会してしまうのを防ぐため、モーダルウィンドウで確認するように --}}
                                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-center">一度退会するとデータはすべて削除され復旧はできません。</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn dashboard-delete-link" data-dismiss="modal">キャンセル</button>
                                    <button type="submit" class="btn mymazon-delete-submit-button text-white">退会する</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let switchEditUserInfo = (textClass, inputClass, labelClass) => {
        if ($(textClass).css('display') == 'block') {
            $(labelClass).text("キャンセル");
            $(textClass).collapse('hide');
            $(inputClass).collapse('show');
        } else {
            $(labelClass).text("編集");
            $(textClass).collapse('show');
            $(inputClass).collapse('hide');
        }
    }
</script>
@endsection