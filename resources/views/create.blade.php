@extends('layouts.app')

@section('content')
<!--
<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100">
-->
<div class="card h-100">
        <div class="card-header">新規メモ作成</div>
        <div class="card-body">
            <form method='POST' action="/store">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                <div class="form-group">
                     <textarea name='content' class="form-control"rows="10"></textarea>
                </div>

                <br>
                <div class="form-group">
                    <label for="tagcontent">タグ【入力】</label>
                    <input name='tagcontent' type="text" class="form-control" id="tagcontent" placeholder="タグを入力（最大３０文字まで入力できます）">
                </div>
            @if( $user['admin_code'] <= 7 )
                <br>
                <button type='submit' class="btn btn-primary btn-lg">保存</button>
            @endif
            </form>
        </div>
    </div>
<!--
</div>
-->
@endsection