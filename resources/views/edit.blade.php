@extends('layouts.app')

@section('content')
<!--
<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100">
-->
    <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
            メモ編集
            <form method='POST' action="/delete/{{$memo['id']}}" id='delete-form'>
            @csrf
            @if( $user['admin_code'] < 9 )
                <button class='p-0 mr-2' style='border:none;'><i id='delete-button' class="fas fa-trash"></i></button>メモの削除
            @endif
            </form>  
        </div>
        <div class="card-body">
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