<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Icon;
use App\Http\Models\Type;
use App\Http\Requests\Admin\IconRequest;
use App\Http\Controllers\Controller;

class IconController extends Controller
{
    private $formData = [
        'name' => '',
        'type' => 0,
        'width' => 0,
        'height' => 0,
        'radius' => 0,
    ];

    public function index()
    {
        $icons = Icon::all();
        return view('admin.icon.index', compact('icons'));
    }

    public function create()
    {
        $data = [];
        foreach ($this->formData as $k => $v) {
            $data [$k] = old($k, $v);
        }
        return view('admin.icon.create', compact('data'))->with($this->types());
    }

    public function store(IconRequest $request)
    {
        $input = $request->only(array_keys($this->formData));
        if (Icon::create($input)) {
            return redirect('admin/icon')->with('msg', '成功');
        }
        return back()->withInput($input)->withErrors('添加失败');
    }

    public function edit(Icon $icon)
    {
        $data = [];
        $id = $icon->id;
        $data['id'] = $id;
        foreach ($this->formData as $k => $v) {
            $data[$k] = old($k, $icon->$k);
        }
        return view('admin.icon.edit', compact('data'))->with($this->types());
    }

    public function update(IconRequest $request, Icon $icon)
    {
        $input = $request->only(array_keys($this->formData));
        $icon->fill($input);

        if ($icon->save()) {
            return redirect('admin/icon')->with('msg', '成功');
        }
        return back()->withInput($input)->withErrors('修改失败');
    }

    public function types()
    {
        return ['types' => Type::orderBy('id')->orderBy('order')->where(['pid' => 1])->select(['id', 'name'])->get()];
    }
}
