<?php

use Illuminate\Database\Seeder;

use \App\Http\Models\Admin\Font;

class FontSeeder extends Seeder
{

    public function run()
    {
        Font::truncate();
        Font::insert([
            [
                'font' => '微软雅黑',
                'font_family' => 'Microsoft YaHei'
            ],
            [
                'font' => '宋体',
                'font_family' => 'SimSun',
            ],
            [
                'font' => 'Arial',
                'font_family' => 'Arial',
            ],
            [
                'font' => 'Tahoma',
                'font_family' => 'Tahoma',
            ],
            [
                'font' => 'Verdana',
                'font_family' => 'Verdana',
            ],
            [
                'font' => '华文黑体',
                'font_family' => 'STHeiti',
            ],
            [
                'font' => '华文细黑',
                'font_family' => 'STXihei',
            ],
            [
                'font' => '黑体-简',
                'font_family' => 'Heiti SC',
            ],
            [
                'font' => '苹方',
                'font_family' => 'PingFang SC',
            ],
            [
                'font' => 'San Francisco',
                'font_family' => 'San Francisco',
            ],
            [
                'font' => 'Helvetica',
                'font_family' => 'Helvetica',
            ],
            [
                'font' => 'Helvetica Neue',
                'font_family' => 'Helvetica Neue',
            ],
            [
                'font' => '冬青黑体',
                'font_family' => 'Hiragino Sans GB',
            ],
            [
                'font' => 'WenQuanYi Micro Hei',
                'font_family' => 'WenQuanYi Micro Hei',
            ],
            [
                'font' => 'sans-serif',
                'font_family' => 'sans-serif',
            ],
        ]);
    }
}
