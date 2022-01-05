<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    public function myMemo($user_id){
        $tag = \Request::query('tag');
        $stag = session()->get('tag'); // セッション情報にあるtagを取得する。

        if(empty($tag) && empty($stag)){
            // タグ一覧がクリックされてない時
            // かつ　セッション情報にあるtagがnullの場合
            $tag = 'all';
        } else if($tag === 'all'){
            // タグ一覧で「全て表示」を選択していた場合
            session()->forget('tag'); // セッション情報からタグ一覧の絞り込み用keyを削除する。
        } else if(!empty($tag)) {
            // タグ一覧で、どれかを選択していた場合

        } else if(!empty($stag)) {
            // セッション情報にあるtagが取得できた場合
            $tag = $stag;
        }

//        dd($tag);
        // タグがなければ、その人が持っているメモを全て取得
//        if(empty($tag)){
        if($tag === 'all'){
            return $this::select('memos.*')->where('user_id', $user_id)->where('status', 1)
            ->orderBy('memos.id', 'DESC')->get();
//                ->orderBy('updated_at', 'DESC')->get();
        }else{
            // もしタグの指定があればタグで絞る ->wher(tagがクエリパラメーターで取得したものに一致)
            $memos = $this::select('memos.*')
                ->leftJoin('tags', 'tags.id', '=','memos.tag_id')
                ->where('tags.name', $tag)
                ->where('tags.user_id', $user_id)
                ->where('memos.user_id', $user_id)
                ->where('status', 1)
                ->orderBy('memos.id', 'DESC')
//                ->orderBy('updated_at', 'DESC')
                ->get();

            // タグ一覧が選択された場合、セッション情報にも保持しておく
            session()->put('tag', $tag);

            return $memos;
        }
    }

//    use HasFactory;
}
