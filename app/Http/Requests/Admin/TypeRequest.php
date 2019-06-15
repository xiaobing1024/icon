<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class TypeRequest extends Request
{
    public function rules()
    {
        $r = Rule::unique('types', 'name');
        $i = '';
        if (!$this->isMethod('post')) {
            $i = 'required';
            $r->ignore($this->id, 'id');
        }
        return [
            'id'   =>  $i,
            'name' => [
                'bail',
                'required',
                $r
            ],

            'type'  => 'integer',
            'order' => 'integer',
        ];
    }
}
