@extends('layouts.app')

@section('content')
<!--
<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100">
-->
    <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
            タグ編集
        </div>
        <div class="card-body">

            <form method='POST' action="{{ route('tagupdate', ['id' => $seltag['id'] ] ) }}">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">

                <div class="form-group">
                    <label for="taglist">登録済みのタグ一覧</label>
                    <select class='form-control' name='tag_id'>
                @foreach($tags as $tag)
                    <option value="{{ $tag['id'] }}" {{ $tag['id'] == $seltag['id'] ? "selected" : "" }}>{{$tag['name']}}</option>
                @endforeach
                    </select>
                </div>

                <br>

                <div class="form-group">
                    <label for="tagcontent">編集中のタグ『{{ $seltag['name'] }}』</label>
                    <input name='tagcontent' type="text" class="form-control" id="tagcontent" placeholder="タグを入力（最大３０文字まで入力できます）">
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