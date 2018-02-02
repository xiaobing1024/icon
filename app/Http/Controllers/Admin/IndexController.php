<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function refreshCache()
    {
        $types = Type::where('pid', 1)->orderBy('order')->select('id', 'name')->get()->toArray();
        cache()->forever('icon_type_list_json', $types);

        return redirect('admin')->with('success', '更新成功');
    }
}
