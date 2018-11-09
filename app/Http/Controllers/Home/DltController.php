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
        $data = Dlt::latest('no')->simplePaginate(20);

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

            $data = $crawler->filterXPath('html/body/div[3]/div[2]/div[2]/table/tbody/tr[1]')->each(function (Crawler $node, $i) use ($now) {
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
        if (strlen($request->kw) == 10) {
            $data = Dlt::where('number', 'like', $request->kw . '%')->get() ?? [];
        } else {
            $data = Dlt::where('number', $request->kw)->get() ?? [];
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
            'msg' => '',
            'data' => $data
        ];
    }
}
