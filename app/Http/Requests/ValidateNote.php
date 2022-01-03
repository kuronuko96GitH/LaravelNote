<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateNote extends FormRequest
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
//            'content' => 'required|max:255',
            'content' => 'required',
//            'tag' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'content' => 'メモ',
            'tag' => 'タグ',
        ];
    }
}
