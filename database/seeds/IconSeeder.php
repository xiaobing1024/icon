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
            'name' => 'ic_launcher',
            'type' => 3,
            'width' => 512,
            'height' => 512,
        ],
        [
            'name' => 'mipmap-hdpi/ic_launcher',
            'type' => 3,
            'width' => 72,
            'height' => 72,
        ],
        [
            'name' => 'mipmap-ldpi/ic_launcher',
            'type' => 3,
            'width' => 36,
            'height' => 36,
        ],
        [
            'name' => 'mipmap-mdpi/ic_launcher',
            'type' => 3,
            'width' => 48,
            'height' => 48,
        ],
        [
            'name' => 'mipmap-xhdpi/ic_launcher',
            'type' => 3,
            'width' => 96,
            'height' => 96,
        ],
        [
            'name' => 'mipmap-xxhdpi/ic_launcher',
            'type' => 3,
            'width' => 144,
            'height' => 144,
        ],
        [
            'name' => 'mipmap-xxxhdpi/ic_launcher',
            'type' => 3,
            'width' => 192,
            'height' => 192,
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

    private $webapp = [
        [
            'name' => 'android-touch-icon',
            'type' => 8,
            'width' => 58,
            'height' => 58,
        ],
        [
            'name' => 'apple-touch-icon-76x76',
            'type' => 8,
            'width' => 76,
            'height' => 76,
        ],
        [
            'name' => 'apple-touch-icon-120x120',
            'type' => 8,
            'width' => 120,
            'height' => 120,
        ],
        [
            'name' => 'apple-touch-icon-152x152',
            'type' => 8,
            'width' => 152,
            'height' => 152,
        ],
        [
            'name' => 'apple-touch-icon-180x180',
            'type' => 8,
            'width' => 180,
            'height' => 180,
        ],
    ];

    private $windowsphone = [
        [
            'name' => 'Logo',
            'type' => 9,
            'width' => 150,
            'height' => 150,
        ],
        [
            'name' => 'Logo210x210',
            'type' => 9,
            'width' => 210,
            'height' => 210,
        ],
        [
            'name' => 'Logo360x360',
            'type' => 9,
            'width' => 360,
            'height' => 360,
        ],
        [
            'name' => 'SmallLogo',
            'type' => 9,
            'width' => 44,
            'height' => 44,
        ],
        [
            'name' => 'SmallLogo62x62',
            'type' => 9,
            'width' => 62,
            'height' => 62,
        ],
        [
            'name' => 'SmallLogo106x106',
            'type' => 9,
            'width' => 160,
            'height' => 160,
        ],
        [
            'name' => 'Square71x71Logo',
            'type' => 9,
            'width' => 71,
            'height' => 71,
        ],
        [
            'name' => 'Square99x99Logo',
            'type' => 9,
            'width' => 99,
            'height' => 99,
        ],
        [
            'name' => 'Square170x170Logo',
            'type' => 9,
            'width' => 170,
            'height' => 170,
        ],
        [
            'name' => 'StoreLogo',
            'type' => 9,
            'width' => 50,
            'height' => 50,
        ],
        [
            'name' => 'StoreLogo70x70',
            'type' => 9,
            'width' => 70,
            'height' => 70,
        ],
        [
            'name' => 'StoreLogo120x120',
            'type' => 9,
            'width' => 120,
            'height' => 120,
        ],
    ];

    public function run()
    {
        $arr = array_merge(
            $this->ios,
            $this->android,
            $this->wx,
            $this->qq,
            $this->ipad,
            $this->iwatch,
            $this->webapp,
            $this->windowsphone
        );
        Icon::insert($arr);
    }
}
