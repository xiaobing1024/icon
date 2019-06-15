<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Admin\Map;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class MapController extends Controller
{
    private $formData = [
        'key' => '',
        'value' => '',
        'type' => '',
    ];

    public function index()
    {
        $maps = Map::get();
        return view('admin.map.index', compact('maps'));
    }

    public function create()
    {
        $arr = [];
        foreach ($this->formData as $k => $v) {
            $arr[$k] = old($k, $v);
        }
        return view('admin.map.create')->with('data', $arr);
    }

    public function store(Request $request)
    {
        $input = $request->only(array_keys($this->formData));
        if (Map::create($input)) {
            cache()->forever('map', Map::pluck('value', 'key')->toArray());
            return redirect('admin/map')->with('msg', '成功');
        }

        return back()->withInput($input)->withErrors('添加失败');
    }

    public function edit(Map $map)
    {
        $arr = [];
        $id = $map->id;
        $arr['id'] = $id;
        foreach ($this->formData as $k => $v) {
            $arr[$k] = old($k, $map->$k);
        }
        return view('admin.map.edit')->with('data', $arr);
    }

    public function update(Request $request, Map $map)
    {
        $input = $request->only(array_keys($this->formData));
        $map->fill($input);

        if ($map->save()) {
            cache()->forever('map', Map::pluck('value', 'key')->toArray());
            return redirect('admin/map')->with('msg', '成功');
        }
        return back()->withInput($input)->withErrors('修改失败');
    }
}
