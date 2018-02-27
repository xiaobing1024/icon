<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FontRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'font'=>'required',
            'font_family'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'font.required'  => '文字内容必须填写',
            'font-family.required'=>'文字内容样式必须填写'
        ];
    }
}
