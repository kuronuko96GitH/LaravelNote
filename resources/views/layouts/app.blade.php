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
<!--    <script src="{{ '/js/VueTest.js' }}" defer></script>-->
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

                            @if( $user['admin_code'] === 1 )
                                    <a class="dropdown-item" href="{{ route('VueTest') }}">
                                        {{ __('VueTest') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('phpinfo') }}">
                                        {{ __('phpinfo') }}
                                    </a>
                            @endif
                                </div>

                            </li>
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <form method="POST" action="/stylemode">
                            @csrf
                            @if( $user['style_code'] === 1 )
                                <button type="submit" class="btn btn-info">通常モード</button>
                            @else
                                <button type="submit" class="btn btn-info">ダークモード</button>
                            @endif
                        </form>
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
            <!-- Bootstrap(col-md)により、1:4:6:1の割合で画面レイアウトを四分割しています -->
            <div class="col-md-1 p-0">
            </div>

            <div class="col-md-4 p-0">
              <div class="card h-100">
                <div class="card-header d-flex">
                    <div class="col-md-5 p-0">メモ一覧
                    </div>
                    <div class="col-md-4 p-0">
                    </div>
                    <div class="col-md-3 p-0">
                @if( $user['admin_code'] < 9 )
                        <a class='ml-auto' href='/create'><i class="fas fa-plus-square"></i></a><a href="/create">新規メモ作成</a>
                @endif
                    </div>
                </div>

                <div class="card-body p-2">
            @if( !empty(session()->get('tag'))  )
                @if( $user['admin_code'] < 9 )
                    タグ選択：<a class='ml-auto' href="/tagedit/{{ (session()->get('tag')) }}"><i class="fas fa-edit"></i></a><a href="/tagedit/{{ (session()->get('tag')) }}">タグ編集</a>
                @else
                    タグ選択：
                @endif
                <div class="form-group">
                    <select class='form-control' name='menu_tag_id' onchange="blur(); location.href = options[this.selectedIndex].value;">
                        <option value="/?tag=all">全て表示</option>
                @foreach($tags as $tag)
                        <option value="/?tag={{ $tag['name'] }}" {{ $tag['name'] == (session()->get('tag')) ? "selected" : "" }}>{{$tag['name']}}</option>
                @endforeach
                    </select>
                </div>
            @else
                タグ選択：
                <div class="form-group">
                    <select class='form-control' name='menu_tag_id' onchange="blur(); location.href = options[this.selectedIndex].value;">
                        <option value="/?tag=all">全て表示</option>
                @foreach($tags as $tag)
                        <option value="/?tag={{ $tag['name'] }}">{{$tag['name']}}</option>
                @endforeach
                    </select>
                </div>
            @endif
            <br>

            @if( $user['admin_code'] === 1 )
                    <p class='d-block'>『users』テーブル
                        <br>【id, name, admin_code, email, updated_at】
                    </p>
                @foreach($all_user as $user)
                    <p class='d-block'>{{ $user['id'] }}, {{ $user['name'] }}, {{ $user['admin_code'] }}, {{ $user['email'] }}, {{ $user['updated_at']->timezone("JST")->format('Y/m/d H:i:s') }}</p>
                @endforeach
            @else
                @foreach($memos as $memo)
                    <a href="/edit/{{ $memo['id'] }}" class='d-block'>{{ Str::substr($memo['content'], 0, 32) }}</a>
                @endforeach
            @endif
                </div>
              </div>    
            </div>

            <div class="col-md-6 p-0">
              @yield('content')
            </div>

            <div class="col-md-1 p-0">
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