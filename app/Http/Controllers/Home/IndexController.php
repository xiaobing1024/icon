<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Admin\Font;
use App\Http\Models\Icon;
use App\Http\Models\Temp;
use App\Http\Models\Type;
use App\Http\Requests\Home\IconMakeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image, Zipper, Storage;

class IndexController extends Controller
{
    public function index()
    {
        $key = 'icon_type_list_json';
        if (!cache()->has($key)) {
            $types = Type::where('pid', 1)->orderBy('order')->select('id', 'name', 'icon')->get()->toArray();
            cache()->forever($key, $types);
        } else {
            $types = cache($key);
        }
        return view('home.index', compact('types'));
    }

    public function makeIcon(IconMakeRequest $request)
    {
        if (!$request->hasFile('img') || !$request->file('img')->isValid()) {
            return back()->withErrors('文件上传失败');
        }

        $types = $request->input('type', []);


        $random_path = time() . str_random(5);//制作后存储文件夹

        $img = $request->file('img');//上传的图片

        if (!empty($types)) {
            $icons = Icon::whereIn('type', $types)
                ->with('type')
                ->orderBy('type')
                ->orderBy('order')
                ->orderBy('id')
                ->get();

            foreach ($icons as $icon) {
                $i_path = $random_path . '/file/' . $icon->path_info['dirname'];//图标所处文件夹

                if (!Storage::exists($i_path)) {//文件夹不存在先创建
                    Storage::makeDirectory($i_path);
                }

                $i = Image::make($img->path())
                    ->resize($icon->width, $icon->height);

//            if ($icon->radius > 0) { todo 圆角处理
//                $i->rad($icon->radius);
//            }

                $i->save(Storage::path($i_path) . '/' . $icon->path_info['basename']);
            }
        }

        $size = $request->input('size', '');

        if (!empty($size)) {
            $i_path = $random_path . '/file/';//图标所处文件夹

            if (!Storage::exists($i_path)) {//文件夹不存在先创建
                Storage::makeDirectory($i_path);
            }

            $i = Image::make($img->path())
                ->resize($size, $size);

//            if ($icon->radius > 0) { todo 圆角处理
//                $i->rad($icon->radius);
//            }

            $basename = 'favicon' . $size . '.png';
            $i->save(Storage::path($i_path) . '/' . $basename);


            $i_path = $random_path . '/file/';//图标所处文件夹

            if (!Storage::exists($i_path)) {//文件夹不存在先创建
                Storage::makeDirectory($i_path);
            }

            $i = Image::make($img->path())
                ->resize($size, $size);

//            if ($icon->radius > 0) { todo 圆角处理
//                $i->rad($icon->radius);
//            }

            $basename = 'favicon' . $size . '.ico';
            $i->save(Storage::path($i_path) . '/' . $basename);
        }

        $zip_path = 'zip/' . $random_path . '.zip';

        setlocale(LC_ALL, 'zh_CN.GBK');
        Zipper::make($zip_path)
            ->add(glob(Storage::path($random_path) . '/*'))
            ->close();
        setlocale(LC_ALL, '');

        Storage::deleteDirectory($random_path);

        Temp::create([
            'path' => $zip_path
        ]);

        return redirect('/d')->with([
            'info' => '图片处理完成',
            'path' => basename($zip_path),
        ]);
    }

    public function download()
    {
        return view('home.download');
    }

    public function downloadFile($path)
    {
        if (\Storage::disk('zip')->exists($path)) {
            return response()->download(Storage::disk('zip')->path($path));
        }
        abort(404);
    }

    public function font()
    {
        if (!cache()->has('font')) {
            $font = Font::select('font', 'font_family')->get()->toArray();
            cache()->forever('font', $font);
        }
        $font = cache('font');
        return view('home.font', compact('font'));
    }
}
