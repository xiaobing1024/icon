<?php

use Illuminate\Database\Seeder;
use \App\Http\Models\Temp;

class TempSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = factory(Temp::class)->times(5)->make();
        Temp::insert($data->toArray());
    }
}
