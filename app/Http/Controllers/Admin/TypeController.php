<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Type;
use App\Http\Requests\Admin\TypeRequest;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    private $formData = [
        'name' => '',
        'pid' => 0,
        'order' => 0,
    ];

    public function index()
    {
        return view('admin.type.index')->with($this->types(true));
    }

    public function create()
    {
        $arr = [];
        foreach ($this->formData as $k => $v) {
            $arr[$k] = old($k, $v);
        }
        return view('admin.type.create')->with('data', $arr)->with($this->types());
    }

    public function store(TypeRequest $request)
    {
        $input = $request->only(array_keys($this->formData));
        if (Type::create($request->only(array_keys($this->formData)))) {
            $types = Type::where('pid', 1)->orderBy('order')->select('id', 'name')->get()->toJson();
            cache()->forever('icon_type_list_json', $types);
            return redirect('admin/type')->with('msg', '成功');
        }

        return back()->withInput($input)->withErrors('添加失败');
    }

    public function edit(Type $type)
    {
        $arr = [];
        $id = $type->id;
        $arr['id'] = $id;
        foreach ($this->formData as $k => $v) {
            $arr[$k] = old($k, $type->$k);
        }
        return view('admin.type.edit')->with('data', $arr)->with($this->types(false, $id));
    }

    public function update(TypeRequest $request, Type $type)
    {
        $input = $request->only(array_keys($this->formData));
        $type->fill($input);

        if ($type->save()) {
            $types = Type::where('pid', 1)->orderBy('order')->select('id', 'name')->get()->toJson();
            cache()->forever('icon_type_list_json', $types);
            return redirect('admin/type')->with('msg', '成功');
        }
        return back()->withInput($input)->withErrors('修改失败');
    }

    public function types($bl = false, $id = 0)
    {
        $t = Type::orderBy('id')->orderBy('order')->select(['id', 'name']);
        if (!empty($id)) {
            $t->where('id', '!=', $id);
        }
        $t = $t->get();
        if (!$bl) {
            $t->prepend((object)['id' => 0, 'name' => '顶级']);
        }
        return ['types' => $t];
    }
}
