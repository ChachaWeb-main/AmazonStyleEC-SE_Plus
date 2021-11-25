<nav class="navbar navbar-expand-md navbar-light shadow-sm mymazon-header-container">
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{asset('img/logo.jpg')}}">
    </a>
    <form class="form-inline">
        <div class="form-group">
            <input class="form-control mymazon-header-search-input">
        </div>
        <div class="input-group">
            <button type="submit" class="btn mymazon-header-search-button"><i class="fas fa-search mymazon-header-search-icon"></i></button>
        </div>
    </form>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto mr-5 mt-2">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item mr-5">
                <a class="nav-link" href="{{ route('register') }}"><label>新規登録</label></a>
            </li>
            <li class="nav-item mr-5">
                <a class="nav-link" href="{{ route('login') }}"><label>ログイン</label></a>
            </li>
            <hr>
            <li class="nav-item mr-5">
                <a class="nav-link" href="{{ route('login') }}">
                    <i class="heart far fa-heart fa-lg mr-1"></i><lavel class="text-danger">お気に入り</lavel>
                </a>
            </li>
            <li class="nav-item mr-5">
                <a class="nav-link" href="{{ route('login') }}">
                    <i class="carts-icon fas fa-shopping-cart fa-lg mr-1"></i><lavel class="text-primary">カート</lavel>
                </a>
            </li>
            @else
             <li class="nav-item mr-5">
                <a class="nav-link" href="{{ route('mypage') }}">
                    <i class="myp-icon fas fa-user fa-lg mr-1"></i><label>マイページ</label>
                </a>
            </li>
            <li class="nav-item mr-5">
                <a class="nav-link" href="{{ route('mypage.favorite') }}">
                    <i class="heart far fa-heart fa-lg mr-1"></i><lavel class="text-danger">お気に入り</lavel>
                </a>
            </li>
            <li class="nav-item mr-5">
                <a class="nav-link" href="{{ route('carts.index') }}">
                    <i class="carts-icon fas fa-shopping-cart fa-lg mr-1"></i><lavel class="text-primary">カート</lavel>
                </a>
            </li>
            @endguest
        </ul>
    </div>
</nav>
