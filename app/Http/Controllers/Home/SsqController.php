<?php

namespace App\Http\Controllers\Home;

use App\Http\Models\Ssq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Zttp\Zttp;
use Symfony\Component\DomCrawler\Crawler;

class SsqController extends Controller
{
    public function index()
    {
        $data = Ssq::latest('no')->simplePaginate(20);

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
//                dd('error' . $now . $e->getMessage() . '--------' . $idx);
//            }
//        }
    }


    public function new()
    {
        try {
            DB::beginTransaction();
            $response = Zttp::get('http://kaijiang.zhcw.com/zhcw/html/ssq/list_1.html');

            $body = $response->body();

            $crawler = new Crawler();

            $crawler->addHtmlContent(trim($body));

            $now = now()->toDateTimeString();

            $data = $crawler->filterXPath('html/body/table/tr[3]')->each(function (Crawler $node, $i) use ($now) {
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
            dd('ok' . $now);
        } catch (\Exception $e) {
            DB::rollBack();
            dd('error' . $now . $e->getMessage());
        }
    }


    public function search(Request $request)
    {
        if (strlen($request->kw) == 12) {
            $data = ssq::where('number', 'like', $request->kw . '%')->get() ?? [];
        } else {
            $data = ssq::where('number', $request->kw)->get() ?? [];
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
