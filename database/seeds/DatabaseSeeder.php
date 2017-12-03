<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!App::isLocal()) {
            exit('你不会是想被开除吧 ?');
        }
        // $this->call(UsersTableSeeder::class);
    }
}
