<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $types = Type::where('pid', 1)->orderBy('order')->select('id', 'name')->get()->toJson();
        return view('home.index', compact('types'));
    }

    public function makeIcon(Request $request)
    {
        dd($request->all());
        return 'ak';
    }
}
