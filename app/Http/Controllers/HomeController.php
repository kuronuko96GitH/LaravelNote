<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // 管理者モード用に全ユーザー情報を取得したい。
use App\Models\Memo;
use App\Models\Tag;

use App\Http\Requests\ValidateNote; // ノート画面の入力チェック処理を追加
use App\Http\Requests\ValidateNoteUpd; // ノート画面の入力チェック処理を追加

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

        // 該当するIDのメモをデータベースから取得
        $user = \Auth::user();
        if ( $user['admin_code'] === 1 ) {
            // 管理者ユーザーの場合、usersの全データを取得する。
            $all_user = User::orderBy('id', 'ASC') -> get();
            //取得したメモをViewに渡す
            return view('create', compact('all_user'));
        } else {
            return view('create');
        }


        // 以下のソースコードは、\app\Providers\AppServiceProvider\boot()の共通呼び出しにまとめました。
        // // ログインしているユーザー情報をViewに渡す
        // $user = \Auth::user();        
        // // メモ一覧の取得
        // //（ASC=昇順、DESC=降順）
        // $memos = Memo::where('user_id', $user['id']) -> where('status_code', 1) -> orderBy('updated_at', 'DESC') -> get();
        // return view('create', compact('user', 'memos'));        
    }
    

    public function create()
    {
        // 新規作成画面表示ボタンを押した時は、
        // セッション情報からタグ一覧の絞り込み用keyを削除する。
        // タグ一覧の「全て表示」をクリックした時と同じ状態にする。
        session()->forget('tag');

        // 新規メモ作成画面の呼び出し処理
        return view('create');

        // 以下のソースコードは、\app\Providers\AppServiceProvider\boot()の共通呼び出しにまとめました。
        // // ログインしているユーザー情報をViewに渡す
        // $user = \Auth::user();
        // // // メモ一覧の取得
        // $memos = Memo::where('user_id', $user['id']) -> where('status_code', 1) -> orderBy('updated_at', 'DESC') -> get();
        // //取得したメモをViewに渡す
        // return view('create', compact('user', 'memos'));

    }

//    public function store(Request $request)
    public function store(ValidateNote $request) // App\Http\Requests\ValidateNoteで入力チェック
    {
        // 新規メモ作成の保存ボタンの実行処理
        $data = $request->all();
        // dd($data); // デバッグ用：$dataの中身を確認する。※実行処理も止まるので注意。

        // POSTされたデータをDB（memosテーブル、tagsテーブル）に新規追加
        // MEMOモデルにDBへ保存する命令を出す

        if ( empty($data['tag']) ) {
            //タグデータが入力されてない場合。
            $data['tag'] = 'NoTag';
        } 

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
             'status_code' => 1
        ]);

        // 新規作成処理を押した時は、
        // セッション情報からタグ一覧の絞り込み用keyを削除する。
        // タグ一覧の「全て表示」をクリックした時と同じ状態にする。
        session()->forget('tag');

        // リダイレクト処理
        return redirect()->route('index');
    }

    public function edit($id)
    {
        //dd($memo);
        // 該当するIDのメモをデータベースから取得
        $user = \Auth::user();
        $memo = Memo::where('status_code', 1)->where('id', $id)->where('user_id', $user['id'])
          ->first(); // 条件に該当したデータの一行目を取得する。
        //取得したメモをViewに渡す
        return view('edit',compact('memo'));
    }

//    public function update(Request $request, $id)
    public function update(ValidateNoteUpd $request, $id) // App\Http\Requests\ValidateNoteUpdで入力チェック
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
        // 論理削除なので、status_code=2
        Memo::where('id', $id)->update([ 'status_code' => 2 ]);
        // ↓は物理削除
        // Memo::where('id', $id)->delete();

        // フラッシュメッセージ(※session情報に保持して、一度だけ画面に読み込んで表示させます。再読み込みでは消えるメッセージ)
        return redirect()->route('index')->with('success', 'メモの削除が完了しました。');
    }

   
    public function stylemode(Request $request)
    {
        // 該当するIDのメモをデータベースから取得
        $user = \Auth::user();
        if ( $user['style_code'] === 0 ) {
            // stylesheetの設定情報を、ナイトモードに変更する。
            User::where('id', $user['id'])->update([ 'style_code' => 1 ]);
        } else {
            // stylesheetの設定情報を、通常モード（背景白）に変更する。
            User::where('id', $user['id'])->update([ 'style_code' => 0 ]);
        }
        return redirect()->route('index');
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
