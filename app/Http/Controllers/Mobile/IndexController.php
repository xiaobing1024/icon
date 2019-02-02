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

    public function ssq()
    {
        $data = Ssq::latest('no')->select('day', 'no', 'number')->take(20)->get();
        foreach ($data as $datum) {
            $datum->append(['number_name', 'no_name']);
        }
        // dd($data->toArray());
        return view('mobile.ssq', compact('data'));
    }

    public function dlt()
    {
        $data = Dlt::latest('no')->select('day', 'no', 'number')->take(20)->get();
        foreach ($data as $datum) {
            $datum->append(['number_name', 'no_name']);
        }
        // dd($data->toArray());
        return view('mobile.dlt', compact('data'));
    }

    public function mnxh()
    {
        return view('mobile.mnxh');
    }

    public function ssqSearch(Request $request)
    {
        $arr = explode(',', $request->input('kw'));
        sort($arr);
        $old = array_combine(['red1', 'red2', 'red3', 'red4', 'red5', 'red6'], $arr);

        $data = [];

        $data['data1'] = Ssq::where($old)->get();

        foreach ($data['data1'] as $datum) {
            $datum->append(['number_name', 'no_name']);
        }

        $temp = [];

        for ($i = 0; $i < 6; $i++) {
            $key = 'red' . ($i + 1);

            $pre = (($i == 0 || $i == 5) ? $arr[$i] : $arr[$i - 1]) + 1;

            $aft = $i == 5 ? 34 : $arr[$i + 1];

            for ($j = $pre; $j < $aft; $j++) {
                if ($j != $arr[$i]) {
                    $temp[] = [$key => $j] + $old;
                }
            }
        }

        $data['data2'] = Ssq::where(function ($q) use ($temp) {
            foreach ($temp as $item) {
                $q->orWhere(function ($q) use ($item) {
                    $q->where($item);
                });
            }
        })->get();

        foreach ($data['data2'] as $datum) {
            $datum->append(['number_name', 'no_name']);
        }

        $temp = [];

        for ($i = 0; $i < 5; $i++) {
            $key1 = 'red' . ($i + 1);
            $key2 = 'red' . ($i + 2);

            $pre = ($i == 0 ? $arr[$i] : $arr[$i - 1]) + 1;

            $aft = $i == 4 ? 34 : $arr[$i + 2];

            for ($j = $pre; $j < $aft - 1; $j++) {
                if ($j != $arr[$i] && $j != $arr[$i + 1]) {
                    for ($z = $j + 1; $z < $aft; $z++) {
                        if ($z != $arr[$i + 1]) {
                            $temp[] = [$key1 => $j, $key2 => $z] + $old;
                        }
                    }
                }
            }
        }

        $data['data3'] = Ssq::where(function ($q) use ($temp) {
            foreach ($temp as $item) {
                $q->orWhere(function ($q) use ($item) {
                    $q->where($item);
                });
            }
        })->get();

        foreach ($data['data3'] as $datum) {
            $datum->append(['number_name', 'no_name']);
        }

        return view('mobile.ssqfx', $data + ['kw' => $arr]);
    }

    public function dltSearch(Request $request)
    {
        $arr = explode(',', $request->input('kw'));
        sort($arr);
        $old = array_combine(['red1', 'red2', 'red3', 'red4', 'red5'], $arr);

        $data = [];

        $data['data1'] = Dlt::where($old)->get();

        foreach ($data['data1'] as $datum) {
            $datum->append(['number_name', 'no_name']);
        }

        $temp = [];

        for ($i = 0; $i < 5; $i++) {
            $key = 'red' . ($i + 1);

            $pre = (($i == 0 || $i == 4) ? $arr[$i] : $arr[$i - 1]) + 1;

            $aft = $i == 4 ? 35 : $arr[$i + 1];

            for ($j = $pre; $j < $aft; $j++) {
                if ($j != $arr[$i]) {
                    $temp[] = [$key => $j] + $old;
                }
            }
        }

        $data['data2'] = Dlt::where(function ($q) use ($temp) {
            foreach ($temp as $item) {
                $q->orWhere(function ($q) use ($item) {
                    $q->where($item);
                });
            }
        })->get();

        foreach ($data['data2'] as $datum) {
            $datum->append(['number_name', 'no_name']);
        }

        $temp = [];

        for ($i = 0; $i < 4; $i++) {
            $key1 = 'red' . ($i + 1);
            $key2 = 'red' . ($i + 2);

            $pre = ($i == 0 ? $arr[$i] : $arr[$i - 1]) + 1;

            $aft = $i == 3 ? 35 : $arr[$i + 2];

            for ($j = $pre; $j < $aft - 1; $j++) {
                if ($j != $arr[$i] && $j != $arr[$i + 1]) {
                    for ($z = $j + 1; $z < $aft; $z++) {
                        if ($z != $arr[$i + 1]) {
                            $temp[] = [$key1 => $j, $key2 => $z] + $old;
                        }
                    }
                }
            }
        }

        $data['data3'] = Dlt::where(function ($q) use ($temp) {
            foreach ($temp as $item) {
                $q->orWhere(function ($q) use ($item) {
                    $q->where($item);
                });
            }
        })->get();

        foreach ($data['data3'] as $datum) {
            $datum->append(['number_name', 'no_name']);
        }

        return view('mobile.dltfx', $data + ['kw' => $arr]);
    }

    public function zxsj()
    {
        return view('mobile.zxsj');
    }
}
