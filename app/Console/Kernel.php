<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Zttp\Zttp;
use Symfony\Component\DomCrawler\Crawler;
use App\Http\Models\Ssq;
use App\Http\Models\Dlt;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        //
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            (new TempCron)->deleteTemp();
        })->when(function () {
            return true;
        })->name('delete_temp')
            ->runInBackground()
            ->withoutOverlapping()
            ->everyMinute();


        $schedule->call(function () {
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

                Ssq::insert(array_reverse($data));

                DB::commit();
                info('ssq------->', $data);
                return true;
            } catch (\Exception $e) {
                DB::rollBack();
                info('ssq------->' . $e->getMessage());
                return false;
            }
        })->name('ssq_new')
            ->runInBackground()
            ->withoutOverlapping()
            ->dailyAt('21:20');

        $schedule->call(function () {
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
                info('dlt------->', $data);
                return true;
            } catch (\Exception $e) {
                DB::rollBack();
                info('dlt------->' . $e->getMessage());
                return false;
            }
        })->name('dlt_new')
            ->runInBackground()
            ->withoutOverlapping()
            ->dailyAt('20:40');
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
