<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Dlt;
use App\Http\Models\Ssq;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Zttp\Zttp;
use Symfony\Component\DomCrawler\Crawler;

class SsqController extends Controller
{
    public function wxIndex()
    {
        $ssq = Ssq::latest('no')->select('day', 'number', 'no')->first();
        $dlt = Dlt::latest('no')->select('day', 'number', 'no')->first();

        $w = ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'];

        return $this->json_ok([
            [
                str_split($ssq->number, 2),
                $ssq->day . ' ' . $w[Carbon::parse($ssq->day)->dayOfWeek],
                $ssq->no
            ],
            [
                str_split($dlt->number, 2),
                $dlt->day . ' ' . $w[Carbon::parse($dlt->day)->dayOfWeek],
                $dlt->no
            ]
        ]);
    }

    public function index()
    {
        $data = Ssq::latest('no')->select('day', 'no', 'number')->simplePaginate(20);
        foreach ($data as $datum) {
            $datum->append(['number_name', 'no_name']);
        }
        return $this->json_ok($data);
    }

    public function all(Request $request)
    {
        //20页10秒
//        for ($idx = $request->s; $idx >= $request->e; $idx--) {
//            try {
//                DB::beginTransaction();
//                $response = Zttp::get('http://kaijiang.zhcw.com/zhcw/html/ssq/list_' . $idx . '.html');
//
//                $body = $response->body();
//
//                $crawler = new Crawler();
//
//                $crawler->addHtmlContent(trim($body));
//
//                $now = now()->toDateTimeString();
//
//                $data = $crawler->filterXPath('html/body/table/tr[position()>2 and position()<last()]')->each(function (Crawler $node, $i) use ($now) {
//                    $temp = [];
//
//                    $temp['day'] = $node->filterXPath('//td[1]')->text();
//                    $temp['no'] = $node->filterXPath('//td[2]')->text();
//
//                    $num = $node->filterXPath('//td[3]/em')->each(function (Crawler $node, $i) {
//                        return $node->text();
//                    });
//
//                    $temp += array_combine(['red1', 'red2', 'red3', 'red4', 'red5', 'red6', 'blue'], $num);
//
//                    $temp['number'] = implode('', $num);
//
//                    $temp['created_at'] = $now;
//                    $temp['updated_at'] = $now;
//
//                    return $temp;
//                });
//
//                ssq::insert(array_reverse($data));
//
//                DB::commit();
//                dump('ok' . $now . '--------' . $idx);
//            } catch (\Exception $e) {
//                DB::rollBack();
//                $now = now()->toDateTimeString();
//                dd('error' . $now . $e->getMessage() . '--------' . $idx);
//            }
//        }
    }


    public function new(Request $request)
    {
        try {
            DB::beginTransaction();
            $response = Zttp::get('http://kaijiang.zhcw.com/zhcw/html/ssq/list_1.html');

            $body = $response->body();

            $crawler = new Crawler();

            $crawler->addHtmlContent(trim($body));

            $now = now()->toDateTimeString();

            $data = $crawler->filterXPath('html/body/table/tr[' . $request->input('id', 3) . ']')->each(function (Crawler $node, $i) use ($now) {
                $temp = [];

                $temp['day'] = $node->filterXPath('//td[1]')->text();
                $temp['no'] = $node->filterXPath('//td[2]')->text();

                $num = $node->filterXPath('//td[3]/em')->each(function (Crawler $node, $i) {
                    return $node->text();
                });

                $temp += array_combine(['red1', 'red2', 'red3', 'red4', 'red5', 'red6', 'blue'], $num);

                $temp['number'] = implode('', $num);

                $temp['created_at'] = $now;
                $temp['updated_at'] = $now;

                return $temp;
            });

            Ssq::insert(array_reverse($data));

            DB::commit();
            dd('ok' . $now, $data);
        } catch (\Exception $e) {
            DB::rollBack();
            dd('error' . $now . $e->getMessage());
        }
    }


    public function search(Request $request)
    {
        $arr = explode(',', $request->input('kw'));

        $old = array_combine(['red1', 'red2', 'red3', 'red4', 'red5', 'red6'], $arr);

        $data = [];

        $data['data1'] = Ssq::where($old)->get();

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

        return $this->json_ok($data);
    }

    public function random(Request $request)
    {
        $data = [];

        if (empty($request->data)) {
            $data = collect([
                1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15,
                16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27,
                28, 29, 30, 31, 32, 33
            ])->random(6)->merge(collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16])->random(1))->toArray();
        } else {
            foreach ($request->data as $datum) {
                $data[] = collect(explode(',', $datum['rang']))->random($datum['length']);
            }
        }

        return $this->json_ok($data);
    }

    public function json_ok($data)
    {
        return [
            'code' => 1,
            'msg' => '',
            'data' => $data
        ];
    }
}
