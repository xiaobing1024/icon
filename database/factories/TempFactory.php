<?php

use App\Http\Models\Temp;
use Faker\Generator as Faker;

$factory->define(Temp::class, function (Faker $faker) {
    return [
        'path' => 'zip/' . time() . str_random(5) . '.zip',
        'created_at' => now()->subMinutes(5),
        'updated_at' => now()->subMinutes(5),
    ];
});
