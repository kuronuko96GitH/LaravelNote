@extends('layouts.app')

@section('content')
<!--
<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100">
-->
    <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
            メモ編集【前回更新日：{{ $memo['updated_at']->timezone("JST")->format('Y/m/d H:i:s') }}】
            <form method='POST' action="/delete/{{$memo['id']}}" id='delete-form'>
            @csrf
            @if( $user['admin_code'] < 9 )
                <button class='p-0 mr-2' style='border:none;'><i id='delete-button' class="fas fa-trash"></i></button>メモの削除
            @endif
            </form>  
        </div>
        <div class="card-body">
            <!-- About me用の画像ファイルの表示　※コード固定【暫定版】 -->
            @if( $user['admin_code'] === 9 )
               @if( $memo['id'] === 4 )
                   <img src="/storage/CustomizeList.png" class='w-100 mb-3'/>
               @elseif( $memo['id'] === 2 )
                   <img src="/storage/portfolio02.png" class='w-100 mb-3'/>
                                           
                   <div class="text-center">
                        <div class="card text-white bg-black mb-3" style="max-width: 50rem;">
                            <div class="card-body">
                                <div>『PHP』で製作したポートフォリオ。『Vue.js』で製作した、オセロゲームが遊べます。
                                </div>
                                <div>こちらから⇒<a href="https://kuronuko9646phptest.herokuapp.com" target="_blank" rel="noopener">https://kuronuko9646phptest.herokuapp.com</a></div>
                                <!-- icon add cdn fontawesome free-->
                                <div><i class="fab fa-github fa-2x"></i>  GitHub（公開ソースコード）: <a href="https://github.com/kuronuko96GitH/testphp" target="_blank" rel="noopener">https://github.com/kuronuko96GitH/testphp</a></div>
                            </div>
                        </div>
                    </div>
               @elseif( $memo['id'] === 1 )
                    <img src="/storage/portfolio01.png" class='w-100 mb-3'/>
                        
                    <div class="text-center">
                        <div class="card text-white bg-black mb-3" style="max-width: 50rem;">
                            <div class="card-body">
                                <div>『Ruby』と『JavaScript』で製作したタイピングゲームなどを遊んでみたい方は、
                                </div>
                                <div>こちらから⇒<a href="https://kuronuko9646rubygames.herokuapp.com" target="_blank" rel="noopener">https://kuronuko9646rubygames.herokuapp.com</a></div>
                                <!-- icon add cdn fontawesome free-->
                                <div><i class="fab fa-github fa-2x"></i>  GitHub（公開ソースコード）: <a href="https://github.com/kuronuko96GitH/RubyGames" target="_blank" rel="noopener">https://github.com/kuronuko96GitH/RubyGames</a></div>
                            </div>
                        </div>
                    </div>
               @endif
            @endif



            <form method='POST' action="{{ route('update', ['id' => $memo['id'] ] ) }}">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                <div class="form-group">
                     <textarea name='content' class="form-control"rows="10">{{ $memo['content'] }}</textarea>
                </div>
                <div class="form-group">
                    <select class='form-control' name='tag_id'>
                @foreach($tags as $tag)
                    <option value="{{ $tag['id'] }}" {{ $tag['id'] == $memo['tag_id'] ? "selected" : "" }}>{{$tag['name']}}</option>
                @endforeach
                    </select>
                </div>
            @if( $user['admin_code'] < 9 )
                <button type='submit' class="btn btn-primary btn-lg">更新</button>
            @endif
            </form>
        </div>
    </div>
<!--
</div>
-->
@endsection