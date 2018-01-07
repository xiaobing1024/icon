<?php

use Illuminate\Database\Seeder;

class TempSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = factory(\App\Http\Models\Temp::class)->times(5)->make();
        \App\Http\Models\Temp::insert($data->toArray());
    }
}
