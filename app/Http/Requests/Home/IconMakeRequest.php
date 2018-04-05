<?php

namespace App\Http\Requests\Home;

use App\Http\Requests\Request;

class IconMakeRequest extends Request
{
    public function rules()
    {
        if (empty($this->input('size', ''))) {
            $type = 'required|array';
        } else {
            $type = 'array';
        }

        if (empty($this->input('type', []))) {
            $size = '';
        } else {
            $size = '';
        }

        return [
            'img' => 'bail|required|image|mimes:jpeg,png|max:' . strval(3 * 1024),
            'type' => $type,
            'type.*' => 'integer|min:2',
            'size' => $size
        ];
    }

    public function attributes()
    {
        return [
            'img' => '图片',
            'type' => '类型'
        ];
    }

    public function messages()
    {
        return [
            'img.required' => '请先上传图片',
            'img.image' => '上传文件必须是图片',
            'img.max' => '图片大小不能超过3M',
            'type.required' => '请选择制作类型'
        ];
    }
}
