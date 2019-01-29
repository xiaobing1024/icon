<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Models\Dlt;
use App\Http\Models\Ssq;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $ssq = Ssq::latest('no')->select('day', 'number', 'no')->first();
        $dlt = Dlt::latest('no')->select('day', 'number', 'no')->first();

        $w = ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'];

        $ssq = [
            str_split($ssq->number, 2),
            $ssq->day . ' ' . $w[Carbon::parse($ssq->day)->dayOfWeek],
            $ssq->no
        ];

        $dlt = [
            str_split($dlt->number, 2),
            $dlt->day . ' ' . $w[Carbon::parse($dlt->day)->dayOfWeek],
            $dlt->no
        ];

        return view('mobile.index', compact('ssq', 'dlt'));
    }
}
