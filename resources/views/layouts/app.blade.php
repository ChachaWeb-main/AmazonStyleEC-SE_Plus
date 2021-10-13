<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/f5c648e41d.js" crossorigin="anonymous"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/mymazon.css')}}" rel="stylesheet"> 
<body>
    <div id="app">
        @component('components.header')
        @endcomponent
        
        <main class="py-4 mb-5">
            @yield('content')
        </main>
        
        @component('components.footer')
        @endcomponent
    </div>
</body>
</html>
