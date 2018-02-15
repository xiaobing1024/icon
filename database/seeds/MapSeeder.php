<?php

use Illuminate\Database\Seeder;
use \App\Http\Models\Admin\Map;

class MapSeeder extends Seeder
{
    public function run()
    {
        Map::truncate();
        Map::insert([
            [
                'key' => 'title',
                'value' => 'bingoicon-app图标在线制作',
                'type' => 'meta'
            ],
            [
                'key' => 'keyword',
                'value' => '图标制作,图标在线制作,app图标制作,icon制作,iOS图标在线制作,安卓图标在线制作',
                'type' => 'meta'
            ],
            [
                'key' => 'description',
                'value' => '简单快速的图标在线制作,一键生成iOS,Android,微信开放平台,腾讯开放平台,favicon等多种图标',
                'type' => 'meta'
            ],
            [
                'key' => 'author',
                'value' => 'github.com@xiaobing1024',
                'type' => 'meta'
            ],
        ]);
    }
}
