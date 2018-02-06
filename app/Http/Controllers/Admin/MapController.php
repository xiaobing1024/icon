<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Admin\Map;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapController extends Controller
{
    private $formData = [
        'key' => '',
        'value' => '',
        'type' => '',
    ];

    public function index()
    {
        return view('admin.map.index');
    }

    public function create()
    {
        $arr = [];
        foreach ($this->formData as $k => $v) {
            $arr[$k] = old($k, $v);
        }
        return view('admin.type.create')->with('data', $arr);
    }

    public function store(Request $request)
    {
        $input = $request->only(array_keys($this->formData));
        if (Map::create($input)) {
            $types = Map::pluck('k', '')->toArray();
            cache()->forever('map', $types);
            return redirect('admin/type')->with('msg', '成功');
        }

        return back()->withInput($input)->withErrors('添加失败');
    }

    public function show(Map $map)
    {
        //
    }

    public function edit(Map $map)
    {
        //
    }

    public function update(Request $request, Map $map)
    {
        //
    }

    public function destroy(Map $map)
    {
        //
    }
}
