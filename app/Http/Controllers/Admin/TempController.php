<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Temp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class TempController extends Controller
{
    public function index()
    {
        $data = Temp::orderBy('created_at')->paginate();

        return view('admin.temp.index', compact('data'));
    }

    public function destroy(Temp $temp)
    {
        Storage::deleteDirectory(pathinfo($temp->path, PATHINFO_FILENAME));
        Storage::disk('public')->delete($temp->path);
        $temp->delete();
        return redirect('admin/temp');
    }
}
