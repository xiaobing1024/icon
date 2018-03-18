<?php

use App\Http\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run()
    {
        Type::insert([
            [
                'name' => 'icon',
                'icon' => 'fa fa-image',
                'pid' => 0,
            ],
            [
                'name' => 'iOS',
                'icon' => 'fa fa-apple',
                'pid' => 1,
            ],
            [
                'name' => 'Android',
                'icon' => 'fa fa-android',
                'pid' => 1,
            ],
            [
                'name' => '微信开放平台',
                'icon' => 'fa fa-wechat',
                'pid' => 1,
            ],
            [
                'name' => '腾讯开放平台',
                'icon' => 'fa fa-qq',
                'pid' => 1,
            ],
            [
                'name' => 'iPad',
                'icon' => 'fa fa-apple',
                'pid' => 1,
            ],
            [
                'name' => 'iWatch',
                'icon' => 'fa fa-apple',
                'pid' => 1,
            ],
            [
                'name' => 'webApp',
                'icon' => 'fa fa-desktop',
                'pid' => 1,
            ],
            [
                'name' => 'windowsPhone',
                'icon' => 'fa fa-windows',
                'pid' => 1,
            ],
            [
                'name' => 'favicon',
                'icon' => 'fa fa-fonticons',
                'pid' => 1,
            ],
        ]);
    }
}
