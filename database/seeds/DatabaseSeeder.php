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

//        \App\Http\Models\Admin\User::create([
//            'name' => 'asd',
//            'email' => 'asd@asd.com',
//            'password' => bcrypt('asdasd'),
//        ]);
//
//        $this->call(TypeSeeder::class);
//        $this->call(IconSeeder::class);
        $this->call(TempSeeder::class);
    }
}
