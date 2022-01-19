@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>

                            <div class="col-md-8 offset-md-4">
                            <br>
                            『ゲスト(guest)』で、ログインすることもできます。
                            <br>
                                <input type="button" class="btn btn-secondary" value="ゲストアカウント" id="guest_button">
                            </div>
                            
                            <div class="col-md-8 offset-md-4">
                                <br>
                                開発ドキュメント（テーブル定義書、単体テストなど）を見たい場合は、
                                <br>『About Me』でログインして下さい。
                                <br>
                                    <input type="button" class="btn btn-success" value="About Me" id="aboutme_button">                                    
                                <br>
                            </div>

                            <div class="col-md-8 offset-md-4">
                                <br>
                                『VB.NET』『PHP』『Ruby』など、他の言語で開発した
                                <br>ポートフォリオを見たい場合は、『他のポートフォリオ』でログインして下さい。
                                <br>
                                    <input type="button" class="btn btn-info" value="他のポートフォリオ" id="link_button">                                    
                                <br>
                            </div>

                        </div>
                    </form>
                </div>

                <section class="bg-dark">
                    <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
                        <div class="d-flex justify-content-center">
                            
                            <div class="text-center">
                                <div class="card text-white bg-dark mb-3" style="max-width: 50rem;">
                                    <div class="card-body">
                                        <br>

                                        <div>『Laravel』で製作したWebアプリです。</div>
                                        <div>↓GitHubで、ソースコードも公開しています。</div>
                                        <div><i class="fab fa-github fa-2x"></i>  GitHub: <a href="https://github.com/kuronuko96GitH/LaravelNote" target="_blank" rel="noopener">https://github.com/kuronuko96GitH/LaravelNote</a></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>


            </div>
        </div>
    </div>
</div>
@endsection
