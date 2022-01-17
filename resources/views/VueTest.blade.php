@extends('layouts.app')

@section('content')
<!--
<div class="row justify-content-center ml-0 mr-0 h-100">
    <div class="card w-100">
-->
    <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
            Vue.jsのテスト画面
        </div>
        <div class="card-body">

            <span>Vueを使わない場合</span>
            <br>
            <span>管理者コード：{{ $user['admin_code'] }}</span>
            <hr>            
            <!-- sampleのVue.jsは正常に動く
            <example-component></example-component>
            -->
            <example-component></example-component>
            <vue-test></vue-test>

        </div>
    </div>
<!--
</div>
-->
@endsection