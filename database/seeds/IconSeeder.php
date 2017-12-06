<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Icon;

class IconSeeder extends Seeder
{
    private $ios = [
        [
            'name' => 'icon20@2x',
            'type' => 2,
            'width' => 40,
            'height' => 40,
        ],
        [
            'name' => 'icon20@3x',
            'type' => 2,
            'width' => 60,
            'height' => 60,
        ],
        [
            'name' => 'icon29@2x',
            'type' => 2,
            'width' => 58,
            'height' => 58,
        ],
        [
            'name' => 'icon29@3x',
            'type' => 2,
            'width' => 87,
            'height' => 87,
        ],
        [
            'name' => 'icon40@2x',
            'type' => 2,
            'width' => 80,
            'height' => 80,
        ],
        [
            'name' => 'icon40@3x',
            'type' => 2,
            'width' => 120,
            'height' => 120,
        ],
        [
            'name' => 'icon60@2x',
            'type' => 2,
            'width' => 120,
            'height' => 120,
        ],
        [
            'name' => 'icon60@3x',
            'type' => 2,
            'width' => 180,
            'height' => 180,
        ],
        [
            'name' => 'icon1024',
            'type' => 2,
            'width' => 1024,
            'height' => 1024,
        ]
    ];

    private $android = [
        [
            'name' => 'asd/icon20@2x',
            'type' => 3,
            'width' => 40,
            'height' => 40,
        ],
    ];

    private $wx = [
        [
            'name' => 'icon28',
            'type' => 4,
            'width' => 28,
            'height' => 28,
        ],
        [
            'name' => 'icon108',
            'type' => 4,
            'width' => 108,
            'height' => 108,
        ],
    ];

    private $qq = [
        [
            'name' => 'icon16',
            'type' => 5,
            'width' => 16,
            'height' => 16,
        ],
        [
            'name' => 'icon512',
            'type' => 5,
            'width' => 512,
            'height' => 512,
        ],
    ];

    private $ipad = [
        [
            'name' => 'icon20',
            'type' => 6,
            'width' => 20,
            'height' => 20,
        ],
        [
            'name' => 'icon20@2x',
            'type' => 6,
            'width' => 40,
            'height' => 40,
        ],
        [
            'name' => 'icon29',
            'type' => 6,
            'width' => 29,
            'height' => 29,
        ],
        [
            'name' => 'icon29@2x',
            'type' => 6,
            'width' => 58,
            'height' => 58,
        ],
        [
            'name' => 'icon40',
            'type' => 6,
            'width' => 40,
            'height' => 40,
        ],
        [
            'name' => 'icon40@2x',
            'type' => 6,
            'width' => 80,
            'height' => 80,
        ],
        [
            'name' => 'icon76',
            'type' => 6,
            'width' => 76,
            'height' => 76,
        ],
        [
            'name' => 'icon76@2x',
            'type' => 6,
            'width' => 152,
            'height' => 152,
        ],
        [
            'name' => 'icon83.5@2x',
            'type' => 6,
            'width' => 167,
            'height' => 167,
        ],
        [
            'name' => 'icon1024',
            'type' => 6,
            'width' => 1024,
            'height' => 1024,
        ],
    ];

    private $iwatch = [
        [
            'name' => 'icon24@2x',
            'type' => 7,
            'width' => 48,
            'height' => 48,
        ],
        [
            'name' => 'icon27.5@2x',
            'type' => 7,
            'width' => 55,
            'height' => 55,
        ],
        [
            'name' => 'icon29@2x',
            'type' => 7,
            'width' => 58,
            'height' => 58,
        ],
        [
            'name' => 'icon29@3x',
            'type' => 7,
            'width' => 87,
            'height' => 87,
        ],
        [
            'name' => 'icon40@2x',
            'type' => 7,
            'width' => 80,
            'height' => 80,
        ],
        [
            'name' => 'icon44@2x',
            'type' => 7,
            'width' => 88,
            'height' => 88,
        ],
        [
            'name' => 'icon86@2x',
            'type' => 7,
            'width' => 172,
            'height' => 172,
        ],
        [
            'name' => 'icon98@2x',
            'type' => 7,
            'width' => 196,
            'height' => 196,
        ],
        [
            'name' => 'icon1024',
            'type' => 7,
            'width' => 1024,
            'height' => 1024,
        ],
    ];

    public function run()
    {
        $arr = array_merge($this->ios, $this->android, $this->wx, $this->qq, $this->ipad, $this->iwatch);
        Icon::insert($arr);
    }
}
