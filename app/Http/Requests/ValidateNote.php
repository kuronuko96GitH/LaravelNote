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
//            'content' => 'required',
            'content' => 'required|max:255',
            'tagcontent' => 'max:30',
        ];
    }

    public function attributes()
    {
        return [
            'content' => 'メモ',
            'tagcontent' => 'タグ',
        ];
    }
}
