<?php

namespace App\Http\Requests\Home;

use App\Http\Requests\Request;

class XycRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'string|max:20',
            'msg' => 'string|max:255'
        ];
    }

    public function attributes()
    {
        return [
            'name' => '姓名/昵称',
            'msg' => '愿望'
        ];
    }
}
