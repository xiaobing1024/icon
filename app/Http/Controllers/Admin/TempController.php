<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Temp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class TempController extends Controller
{
    public function index()
    {
        //数据库历史记录
        $data = Temp::orderBy('created_at')->paginate();

        //所有zip文件
        $zipStorage = Storage::disk('zip');
        $zipFiles = $zipStorage->files();
        $zips = [];
        foreach ($zipFiles as $item) {
            $v = [];
            $v['file_name'] = $item;
            $v['updated_at'] = Carbon::createFromTimestamp($zipStorage->lastModified($item))->toDateTimeString();
            $zips[] = (object)$v;
        }

        //所有上传文件
        $iconStorage = Storage::disk('icon');
        $iconFiles = $iconStorage->directories();
        $icons = [];
        foreach ($iconFiles as $item) {
            $v1 = [];
            $v1['file_name'] = $item;
            $v1['updated_at'] = Carbon::createFromTimestamp($iconStorage->lastModified($item))->toDateTimeString();
            $icons[] = (object)$v1;
        }
        return view('admin.temp.index', compact('data', 'zips', 'icons'));
    }

    public function destroy(Temp $temp)
    {
        Storage::deleteDirectory(pathinfo($temp->path, PATHINFO_FILENAME));
        Storage::disk('public')->delete($temp->path);
        $temp->delete();
        return redirect('admin/temp');
    }

    public function deletePath(Request $request)
    {
        if ($request->input('type', 'icon') == 'icon') {
            Storage::disk('icon')->deleteDirectory($request->path);
            return redirect('admin/temp');
        }

        Storage::disk('zip')->delete($request->path);
        return redirect('admin/temp');
    }
}
