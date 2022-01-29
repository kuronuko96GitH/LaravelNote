@extends('layouts.app')

@section('content')
<!--
<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100">
-->
    <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
            メモ編集【前回更新日：{{ $memo['updated_at']->timezone("JST")->format('Y/m/d H:i:s') }}】
        </div>
        <div class="card-body">
        <!-- About me用の画像ファイルの表示　※memo_id（コード固定【暫定版】） -->
        @if( $memo['id'] === 20 )
            <img src="/storage/TableLayout_users.png" class='w-100 mb-3'/>
        @elseif( $memo['id'] === 19 )
            <img src="/storage/TableLayout_memos.png" class='w-100 mb-3'/>
        @elseif( $memo['id'] === 18 )
            <img src="/storage/TableLayout_tags.png" class='w-100 mb-3'/>
        @elseif( $memo['id'] === 17 )
            <img src="/storage/CustomizeList.png" class='w-100 mb-3'/>
        @elseif( $memo['id'] === 16 )
            <img src="/storage/Pcl01.png" class='w-100 mb-3'/>
        @elseif( $memo['id'] === 15 )
            <img src="/storage/Pcl02.png" class='w-100 mb-3'/>
                                    
        @elseif( $memo['id'] === 13 )
                <img src="/storage/portfolio05.png" class='w-100 mb-3'/>
                
                <div class="text-center">
                    <div class="card text-white bg-black mb-3" style="max-width: 50rem;">
                        <div class="card-body">
                            <div>『Spring Boot』(Javaのフレームワーク)で製作したWebアプリです。
                            </div>
                            <div>こちらから⇒<a href="https://kuronuko9646spring.herokuapp.com" target="_blank" rel="noopener">https://kuronuko9646spring.herokuapp.com</a></div>
                            <!-- icon add cdn fontawesome free-->
                            <div><i class="fab fa-github fa-2x"></i>  GitHub（公開ソースコード）: <a href="https://github.com/kuronuko96GitH/HerokuSpring" target="_blank" rel="noopener">https://github.com/kuronuko96GitH/HerokuSpring</a></div>
                        </div>
                    </div>
                </div>

        @elseif( $memo['id'] === 12 )
                <img src="/storage/portfolio02.jpg" class='w-100 mb-3'/>
                                            
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

        @elseif( $memo['id'] === 11 )
                <img src="/storage/portfolio01.jpg" class='w-100 mb-3'/>
                
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
    
        @elseif( $memo['id'] === 10 )
<!--
            <img src="/storage/portfolio01.jpg" class='w-100 mb-3'/>
-->
        @elseif( $memo['id'] === 9 )
<!--
            <img src="/storage/portfolio01.jpg" class='w-100 mb-3'/>
-->
        @elseif( $memo['id'] === 8 )
<!--
            <img src="/storage/portfolio01.jpg" class='w-100 mb-3'/>
-->
        @elseif( $memo['id'] === 7 )
<!--
            <img src="/storage/portfolio01.jpg" class='w-100 mb-3'/>
-->
        @elseif( $memo['id'] === 6 )
            <div class="text-center">
                <div class="card text-white bg-black mb-3" style="max-width: 50rem;">
                    <div class="card-body">
                        <div>実際に開発したソースコードは、こちらで公開してます。
                        </div>
                        <!-- icon add cdn fontawesome free-->
                        <div><i class="fab fa-github fa-2x"></i>  GitHub（公開ソースコード）: <a href="https://github.com/kuronuko96GitH/WinAppTStamp" target="_blank" rel="noopener">https://github.com/kuronuko96GitH/WinAppTStamp</a></div>
                    </div>
                </div>
            </div>

        @elseif( $memo['id'] === 5 )
            <img src="/storage/VB01.png" class='w-100 mb-3'/>
        @elseif( $memo['id'] === 4 )
            <img src="/storage/VB02.png" class='w-100 mb-3'/>
        @elseif( $memo['id'] === 3 )
            <img src="/storage/VB03.png" class='w-100 mb-3'/>
        @elseif( $memo['id'] === 2 )
            <img src="/storage/VB04.png" class='w-100 mb-3'/>
        @elseif( $memo['id'] === 1 )
            <img src="/storage/VB05.png" class='w-100 mb-3'/>
        @endif

            <form method='POST' action="{{ route('update', ['id' => $memo['id'] ] ) }}">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                <div class="form-group">
                    <textarea name='content' class="form-control"rows="10">{{ $memo['content'] }}</textarea>
                </div>
                
                <br>

                <div class="form-group">
                    <label for="tag_id">タグ【選択】</label>
                    <select class='form-control' name='tag_id'>
                @foreach($tags as $tag)
                    <option value="{{ $tag['id'] }}" {{ $tag['id'] == $memo['tag_id'] ? "selected" : "" }}>{{$tag['name']}}</option>
                @endforeach
                    </select>
                </div>
            @if( $user['admin_code'] <= 7 )
                <br>
                <button type='submit' class="btn btn-primary btn-lg">更新</button>
            @endif
            </form>

            <br>
            <form method='POST' action="/delete/{{$memo['id']}}" id='delete-form'>
                        @csrf
                        @if( $user['admin_code'] <= 7 )
                            <button class='p-0 mr-2' style='border:none;'><i id='delete-button' class="fas fa-trash-alt fa-3x"></i></button> メモの削除
                        @endif
            </form>
        </div>
    </div>
<!--
</div>
-->
@endsection