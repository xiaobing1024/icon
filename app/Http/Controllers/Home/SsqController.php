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
        $data = Ssq::latest('no')->select('day', 'no', 'number', 'red1', 'red2', 'red3', 'red4', 'red5', 'red6', 'blue')->first();
        dd("$data->day -- $data->red1,$data->red2,$data->red3,$data->red4,$data->red5,$data->red6,$data->blue");
//        foreach ($data as $datum) {
//            $datum->append(['number_name', 'no_name']);
//        }
//        return $this->json_ok($data);
    }

    public function all(Request $request)
    {
//        http://127.0.0.1:8000/api/ssq/all?s=29&e=1
        //20页10秒
        dd(2);
        for ($idx = $request->s; $idx >= $request->e; $idx--) {
            try {
                DB::beginTransaction();
                $response = Zttp::get('http://kaijiang.zhcw.com/zhcw/html/ssq/list_' . $idx . '.html');

                $body = $response->body();

                $crawler = new Crawler();

                $crawler->addHtmlContent(trim($body));

                $now = now()->toDateTimeString();

                $data = $crawler->filterXPath('html/body/table/tr[position()>2 and position()<last()]')->each(function (Crawler $node, $i) use ($now) {
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

                ssq::insert(array_reverse($data));

                DB::commit();
                dump('ok' . $now . '--------' . $idx);
            } catch (\Exception $e) {
                DB::rollBack();
                $now = now()->toDateTimeString();
                dd('error' . $now . $e->getMessage() . '--------' . $idx);
            }
        }
        dd(1);
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
        sort($arr);
        $old = array_combine(['red1', 'red2', 'red3', 'red4', 'red5', 'red6'], $arr);

        $data = [];

        $data['data1'] = Ssq::where($old)->get();

        $where = [];

        $temp = combination($arr, 5);

        foreach ($temp as $t) {
            $where[] = array_combine(['red1', 'red2', 'red3', 'red4', 'red5'], $t);
            $where[] = array_combine(['red1', 'red2', 'red3', 'red4', 'red6'], $t);

            $where[] = array_combine(['red1', 'red2', 'red3', 'red5', 'red6'], $t);

            $where[] = array_combine(['red1', 'red2', 'red4', 'red5', 'red6'], $t);

            $where[] = array_combine(['red1', 'red3', 'red4', 'red5', 'red6'], $t);

            $where[] = array_combine(['red2', 'red3', 'red4', 'red5', 'red6'], $t);
        }

        $data['data2'] = Ssq::where(function ($q) use ($where) {
            foreach ($where as $item) {
                $q->orWhere(function ($q) use ($item) {
                    $q->where($item);
                });
            }
        })->get();

        $temp = [];
        foreach ($data['data2'] as $datum) {
            $add = true;
            foreach ($data['data1'] as $o) {
                if ($o->no == $datum->no) {
                    $add = false;
                    break;
                }
            }
            if ($add) {
                $datum->append(['number_name', 'no_name']);
                $temp[] = $datum;
            }
        }
        $data['data2'] = $temp;

        $temp = [];
        foreach ($data['data2'] as $datum) {
            $add = true;
            foreach ($data['data1'] as $o) {
                if ($o->no == $datum->no) {
                    $add = false;
                    break;
                }
            }
            if ($add) {
                $datum->append(['number_name', 'no_name']);
                $temp[] = $datum;
            }
        }
        $data['data2'] = $temp;

        $where = [];

        $temp = combination($arr, 4);
        foreach ($temp as $t) {
            $where[] = array_combine(['red1', 'red2', 'red3', 'red4'], $t);
            $where[] = array_combine(['red1', 'red2', 'red3', 'red5'], $t);
            $where[] = array_combine(['red1', 'red2', 'red3', 'red6'], $t);

            $where[] = array_combine(['red1', 'red2', 'red4', 'red5'], $t);
            $where[] = array_combine(['red1', 'red2', 'red4', 'red6'], $t);
            $where[] = array_combine(['red1', 'red2', 'red5', 'red6'], $t);

            $where[] = array_combine(['red1', 'red3', 'red4', 'red5'], $t);
            $where[] = array_combine(['red1', 'red3', 'red4', 'red6'], $t);
            $where[] = array_combine(['red1', 'red3', 'red5', 'red6'], $t);
            $where[] = array_combine(['red1', 'red4', 'red5', 'red6'], $t);

            $where[] = array_combine(['red2', 'red3', 'red4', 'red5'], $t);
            $where[] = array_combine(['red2', 'red3', 'red4', 'red6'], $t);
            $where[] = array_combine(['red2', 'red3', 'red5', 'red6'], $t);
            $where[] = array_combine(['red2', 'red4', 'red5', 'red6'], $t);
            $where[] = array_combine(['red3', 'red4', 'red5', 'red6'], $t);
        }

        $data['data3'] = Ssq::where(function ($q) use ($where) {
            foreach ($where as $item) {
                $q->orWhere(function ($q) use ($item) {
                    $q->where($item);
                });
            }
        })->get();

        $temp = [];
        foreach ($data['data3'] as $datum) {
            $add = true;
            foreach ($data['data1'] as $o) {
                if ($o->no == $datum->no) {
                    $add = false;
                    break;
                }
            }
            if ($add) {
                $datum->append(['number_name', 'no_name']);
                $temp[] = $datum;
            }
        }

        $data['data3'] = [];
        foreach ($temp as $datum) {
            $add = true;
            foreach ($data['data2'] as $o) {
                if ($o->no == $datum->no) {
                    $add = false;
                    break;
                }
            }
            if ($add) {
                $datum->append(['number_name', 'no_name']);
                $data['data3'][] = $datum;
            }
        }
        foreach ($data as $k => $datum) {
            $c = ['data1' => 6, 'data2' => 5, 'data3' => 4][$k];
            $a = array_reverse(is_array($datum) ? $datum : $datum->toArray());
            foreach ($a as $v) {
                $t = [];
                foreach ($old as $key => $vv) {
                    for ($i = 1; $i <= 6; $i++) {
                        if ($vv == $v->{"red$i"}) {
                            $t[] = $vv;
                        }
                    }
                }
                $t = implode(',', $t);
                dump("$v->day -- $v->red1,$v->red2,$v->red3,$v->red4,$v->red5,$v->red6,$v->blue -- $t -- $c");
            }
        }
        dd(1);

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

        dd(implode(',', $data));
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
