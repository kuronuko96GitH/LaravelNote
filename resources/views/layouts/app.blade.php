<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SimpleNote') }}</title>
    <link rel="icon" type="image/x-icon" href="/storage/favicon.ico" />

    <!-- Scripts -->
    <script src="{{ '/js/app.js' }}" defer></script>
    @yield('js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- CDN ゴミ箱アイコンなど -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ '/css/app.css' }}" rel="stylesheet">
    <link href="{{ '/css/utility.css' }}" rel="stylesheet">
    @if( $user['style_code'] === 1 )
    <!--    Bootstrap-Night の CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-dark-5@1.1.2/dist/css/bootstrap-night.min.css" rel="stylesheet">
    @endif

    @yield('css')
</head>
<body>
    <div id="app">

    @if( $user['style_code'] === 1 )
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
    @else
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    @endif
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <!-- justify-content-end 右寄せ -->
                    <!-- Left Side Of Navbar -->
                    <!-- mr-auto は CSSのmargin-right: autoと同じ効果 -->
                    <ul class="navbar-nav mr-auto">
                        
                    <form method="POST" action="/stylemode">
                        @csrf
                        @if( $user['style_code'] === 1 )
                            <button type="submit" class="btn btn-info">通常モード</button>
                        @else
                            <button type="submit" class="btn btn-info">ダークモード</button>
                        @endif
                    </form>
<!--
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    About Me
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href='/create'>
                                    {{ Auth::user()->name }}
                                    </a>
                                </div>
                            </li>
-->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="main">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
              {{ session('success') }}
            </div>
        @endif
        @if(count($errors) > 0)
        <ul class="bg-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
<!--
            <div class="row" style='height: 92vh;'>
            <div class="row" style='height: 90vh;'>
-->
            <div class="row" style='height: 88vh;'>
            <!-- Bootstrap(col-md)により、2:4:6の割合で画面レイアウトを四分割しています -->
            <div class="col-md-2 p-0">
              <div class="card h-100">
                <div class="card-header">タグ一覧
                </div>
                <div class="card-body py-2 px-4">
        @if( $user['admin_code'] === 1 )
                    <a class='d-block' href='/'>userテーブル<br>(id, name, admin_code, email)</a>
            @foreach($all_user as $user)
                    <p class='d-block'>{{ $user['id'] }}, {{ $user['name'] }}, {{ $user['admin_code'] }}, {{ $user['email'] }}</p>
            @endforeach
        @else
                    <a class='d-block' href='/'>全て表示</a>
            @foreach($tags as $tag)
                    <a href="/?tag={{ $tag['name'] }}" class='d-block'>{{ $tag['name'] }}</a>
            @endforeach
        @endif
                </div>
              </div>
            </div>

            <div class="col-md-4 p-0">
              <div class="card h-100">
                <div class="card-header d-flex">
                    <div class="col-md-5 p-0">メモ一覧
                    </div>
                    <div class="col-md-5 p-0">
                    </div>
                    <div class="col-md-2 p-0">
                @if( $user['admin_code'] < 9 )
                        <a class='ml-auto' href='/create'><i class="fas fa-plus-circle"></i></a>新規作成
                @endif
                    </div>
                </div>

                <div class="card-body p-2">
            @foreach($memos as $memo)
                  <a href="/edit/{{ $memo['id'] }}" class='d-block'>{{ Str::substr($memo['content'], 0, 32) }}</a>
            @endforeach
                </div>
              </div>    
            </div>

            <div class="col-md-6 p-0">
              @yield('content')
            </div>

          </div> <!-- row justify-content-center -->
        </main>
    </div>
    @yield('footer')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- Add class="nav-item dropdown" -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</body>
</html>