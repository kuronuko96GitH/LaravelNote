<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use App\Models\Tag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $memos = Memo::get();
        // dd($memos); // デバッグ用：$dataの中身を確認する。※実行処理も止まるので注意。

        return view('create');

        // 以下のソースコードは、\app\Providers\AppServiceProvider\boot()の共通呼び出しにまとめました。
        // // ログインしているユーザー情報をViewに渡す
        // $user = \Auth::user();        
        // // メモ一覧の取得
        // //（ASC=昇順、DESC=降順）
        // $memos = Memo::where('user_id', $user['id']) -> where('status', 1) -> orderBy('updated_at', 'DESC') -> get();
        // return view('create', compact('user', 'memos'));        
    }
    

    public function create()
    {
        // 新規メモ作成画面の呼び出し処理
        return view('create');

        // 以下のソースコードは、\app\Providers\AppServiceProvider\boot()の共通呼び出しにまとめました。
        // // ログインしているユーザー情報をViewに渡す
        // $user = \Auth::user();
        // // // メモ一覧の取得
        // $memos = Memo::where('user_id', $user['id']) -> where('status', 1) -> orderBy('updated_at', 'DESC') -> get();
        // //取得したメモをViewに渡す
        // return view('create', compact('user', 'memos'));

    }

    public function store(Request $request)
    {
        // 新規メモ作成の保存ボタンの実行処理

        $data = $request->all();
        // dd($data); // デバッグ用：$dataの中身を確認する。※実行処理も止まるので注意。

        // POSTされたデータをDB（memosテーブル、tagsテーブル）に新規追加
        // MEMOモデルにDBへ保存する命令を出す

        // 同じタグがあるか確認
        $exist_tag = Tag::where('name', $data['tag'])->where('user_id', $data['user_id'])->first();
        if( empty($exist_tag['id']) ){
            //新規タグの場合は、タグ情報をtagsテーブルへ新規登録
            $tag_id = Tag::insertGetId(['name' => $data['tag'], 'user_id' => $data['user_id']]);
        }else{
            $tag_id = $exist_tag['id'];
        }

        // memosテーブルに新規登録
        $memo_id = Memo::insertGetId([
            'content' => $data['content'],
             'user_id' => $data['user_id'], 
             'tag_id' => $tag_id,
             'status' => 1
        ]);

        // リダイレクト処理
        return redirect()->route('index');
    }

    public function edit($id)
    {
        // 該当するIDのメモをデータベースから取得
        $user = \Auth::user();
        $memo = Memo::where('status', 1)->where('id', $id)->where('user_id', $user['id'])
          ->first(); // 条件に該当したデータの一行目を取得する。
        //   dd($memo);
        //取得したメモをViewに渡す
        return view('edit',compact('memo'));
    }

    public function update(Request $request, $id)
    {
        // メモ編集の更新ボタン処理
        $inputs = $request->all();
        // dd($inputs);
        Memo::where('id', $id)->update(['content' => $inputs['content'], 'tag_id' => $inputs['tag_id'] ]);
        return redirect()->route('index');
    }

    public function delete(Request $request, $id)
    {
        $inputs = $request->all();
        // dd($inputs);
        // 論理削除なので、status=2
        Memo::where('id', $id)->update([ 'status' => 2 ]);
        // ↓は物理削除
        // Memo::where('id', $id)->delete();

        // フラッシュメッセージ(※session情報に保持して、一度だけ画面に読み込んで表示させます。再読み込みでは消えるメッセージ)
        return redirect()->route('index')->with('success', 'メモの削除が完了しました。');
    }

    public function info()
    {
        // デバッグ用
        return view('phpinfo');
    }

    public function sqltest()
    {
        // デバッグ用
        return view('sqltest');
    }
}