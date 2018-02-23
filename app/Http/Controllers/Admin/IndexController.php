<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Admin\Map;
use App\Http\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class IndexController extends Controller
{
    public function index()
    {
        setlocale(LC_ALL, 'zh_CN.GBK');
        dd(basename('/浪费的空间'));
        return view('admin.index');
    }

    public function refreshCache()
    {
        $types = Type::where('pid', 1)->orderBy('order')->select('id', 'name')->get()->toArray();
        cache()->forever('icon_type_list_json', $types);

        cache()->forever('map', Map::pluck('value', 'key')->toArray());

        return redirect('admin')->with('success', '更新成功');
    }

    public function phpinfo()
    {
        return view('admin.phpinfo');
    }
}
