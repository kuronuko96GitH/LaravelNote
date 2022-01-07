<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateNoteTagUpd extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return false;
        // ここをtrueにしてないと、
        //FormRequestでエラーになり、403エラーが表示されます。
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tagcontent' => 'required|max:30|unique:tags,name',
        ];
    }

    public function attributes()
    {
        return [
            'tagcontent' => 'タグ',
//            'tagcontent.unique' => 'そのタグは既に登録されています。',
        ];
    }
}
