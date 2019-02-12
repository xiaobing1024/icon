<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Dlt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Zttp\Zttp;
use Symfony\Component\DomCrawler\Crawler;

class DltController extends Controller
{
    public function index()
    {
        $data = Dlt::latest('no')->select('day', 'no', 'number')->simplePaginate(20);

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
//                $response = Zttp::get('http://www.lottery.gov.cn/historykj/history_' . $idx . '.jspx?_ltype=dlt');
//
//                $body = $response->body();
//
//                $crawler = new Crawler();
//
//                $crawler->addHtmlContent(trim($body));
//
//                $now = now()->toDateTimeString();
//
//                $data = $crawler->filterXPath('html/body/div[3]/div[2]/div[2]/table/tbody/tr')->each(function (Crawler $node, $i) use ($now) {
//                    $temp = [];
//
//                    $temp['day'] = $node->filterXPath('//td[20]')->text();
//                    $temp['no'] = $node->filterXPath('//td[1]')->text();
//                    $temp['red1'] = $node->filterXPath('//td[2]')->text();
//                    $temp['red2'] = $node->filterXPath('//td[3]')->text();
//                    $temp['red3'] = $node->filterXPath('//td[4]')->text();
//                    $temp['red4'] = $node->filterXPath('//td[5]')->text();
//                    $temp['red5'] = $node->filterXPath('//td[6]')->text();
//                    $temp['blue1'] = $node->filterXPath('//td[7]')->text();
//                    $temp['blue2'] = $node->filterXPath('//td[8]')->text();
//
//                    $temp['number'] = $temp['red1'] . $temp['red2'] . $temp['red3'] . $temp['red4'] . $temp['red5'] . $temp['blue1'] . $temp['blue2'];
//
//                    $temp['created_at'] = $now;
//                    $temp['updated_at'] = $now;
//
//                    return $temp;
//                });
//
//                Dlt::insert(array_reverse($data));
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
            $response = Zttp::get('http://www.lottery.gov.cn/historykj/history_1.jspx?_ltype=dlt');

            $body = $response->body();

            $crawler = new Crawler();

            $crawler->addHtmlContent(trim($body));

            $now = now()->toDateTimeString();

            $data = $crawler->filterXPath('html/body/div[3]/div[2]/div[2]/table/tbody/tr[' . $request->input('id', 1) . ']')->each(function (Crawler $node, $i) use ($now) {
                $temp = [];

                $temp['day'] = $node->filterXPath('//td[20]')->text();
                $temp['no'] = $node->filterXPath('//td[1]')->text();
                $temp['red1'] = $node->filterXPath('//td[2]')->text();
                $temp['red2'] = $node->filterXPath('//td[3]')->text();
                $temp['red3'] = $node->filterXPath('//td[4]')->text();
                $temp['red4'] = $node->filterXPath('//td[5]')->text();
                $temp['red5'] = $node->filterXPath('//td[6]')->text();
                $temp['blue1'] = $node->filterXPath('//td[7]')->text();
                $temp['blue2'] = $node->filterXPath('//td[8]')->text();

                $temp['number'] = $temp['red1'] . $temp['red2'] . $temp['red3'] . $temp['red4'] . $temp['red5'] . $temp['blue1'] . $temp['blue2'];

                $temp['created_at'] = $now;
                $temp['updated_at'] = $now;

                return $temp;
            });

            Dlt::insert(array_reverse($data));

            DB::commit();
            dump('ok' . $now);
        } catch (\Exception $e) {
            DB::rollBack();
            $now = now()->toDateTimeString();
            dd('error' . $now . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        $arr = explode(',', $request->input('kw'));
        sort($arr);
        $old = array_combine(['red1', 'red2', 'red3', 'red4', 'red5'], $arr);

        $data = [];

        $data['data1'] = Dlt::where($old)->get();

        foreach ($data['data1'] as $datum) {
            $datum->append(['number_name', 'no_name']);
        }

        $where = [];

        $temp = combination($arr, 4);

        foreach ($temp as $t) {
            $where[] = array_combine(['red1', 'red2', 'red3', 'red4'], $t);
            $where[] = array_combine(['red1', 'red2', 'red3', 'red5'], $t);

            $where[] = array_combine(['red1', 'red2', 'red4', 'red5'], $t);

            $where[] = array_combine(['red1', 'red3', 'red4', 'red5'], $t);

            $where[] = array_combine(['red2', 'red3', 'red4', 'red5'], $t);
        }

        $data['data2'] = Dlt::where(function ($q) use ($where) {
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

        $where = [];

        $temp = combination($arr, 3);
        foreach ($temp as $t) {
            $where[] = array_combine(['red1', 'red2', 'red3'], $t);
            $where[] = array_combine(['red1', 'red2', 'red4'], $t);
            $where[] = array_combine(['red1', 'red2', 'red5'], $t);

            $where[] = array_combine(['red1', 'red3', 'red4'], $t);
            $where[] = array_combine(['red1', 'red3', 'red5'], $t);
            $where[] = array_combine(['red1', 'red4', 'red5'], $t);

            $where[] = array_combine(['red2', 'red3', 'red4'], $t);
            $where[] = array_combine(['red2', 'red3', 'red5'], $t);
            $where[] = array_combine(['red2', 'red4', 'red5'], $t);
            $where[] = array_combine(['red3', 'red4', 'red5'], $t);
        }

        $data['data3'] = Dlt::where(function ($q) use ($where) {
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

        return $this->json_ok($data);
    }

    public function random(Request $request)
    {
        $data = [];

        if (empty($request->data)) {
            $data = collect([
                1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15,
                16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27,
                28, 29, 30, 31, 32, 33, 34, 35
            ])->random(5)->merge(collect([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12])->random(2))->toArray();
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
            'msg'  => '',
            'data' => $data
        ];
    }
}
