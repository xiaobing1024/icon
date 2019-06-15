<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class IconRequest extends Request
{
    public function rules()
    {
//        $r = Rule::unique('types', 'name');
        $i = '';
        if (!$this->isMethod('post')) {
            $i = 'required';
//            $r->ignore($this->id, 'id');
        }
        return [
            'id'   =>  $i,
            'name' => 'bail|required',
            'type'  => 'integer',
            'width'  => 'integer',
            'height' => 'integer',
            'radius' => 'integer',
        ];
    }
}
