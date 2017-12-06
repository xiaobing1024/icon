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
                'pid' => 0,
            ],
            [
                'name' => 'iOS',
                'pid' => 1,
            ],
            [
                'name' => 'Android',
                'pid' => 1,
            ],
            [
                'name' => '微信开放平台',
                'pid' => 1,
            ],
            [
                'name' => '腾讯开放平台',
                'pid' => 1,
            ],
            [
                'name' => 'iPad',
                'pid' => 1,
            ],
            [
                'name' => 'iWatch',
                'pid' => 1,
            ]
        ]);
    }
}
