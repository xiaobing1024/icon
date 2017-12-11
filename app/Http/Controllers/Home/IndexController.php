<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Type;
use App\Http\Requests\Home\IconMakeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image, Zipper, Storage;

class IndexController extends Controller
{
    public function index()
    {
        $types = Type::where('pid', 1)->orderBy('order')->select('id', 'name')->get()->toJson();
        return view('home.index', compact('types'));
    }

    public function makeIcon(IconMakeRequest $request)
    {
        if (!$request->hasFile('img') || !$request->file('img')->isValid()) {
            return back()->withErrors('文件上传失败');
        }

        $img = $request->file('img');

        Image::make($img->path())
            ->resize(200, 200)
            ->save(public_path('asd.png'));

        return redirect('/')->with([
            'msg' => 'ok'
        ]);
    }
}
