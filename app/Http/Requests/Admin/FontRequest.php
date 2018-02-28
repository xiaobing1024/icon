<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class FontRequest extends Request
{
    public function rules()
    {
        return [
            'font' => 'required|string',
            'font_family' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'font.required' => '文字内容必须填写',
            'font-family.required' => '文字内容样式必须填写'
        ];
    }
}
