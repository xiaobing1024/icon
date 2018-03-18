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
//        if (!App::isLocal()) {
//            exit('你不会是想被开除吧 ?');
//        }
//        new Vue({
//        el: '.asd',
//  data: {
//            text: 'Hello Vue!',
//    backgroundColor: '#FF0000',
//    font_size: 30,
//    font:'Verdana'
//  },
//  computed: {
//            // 计算属性的 getter
//            reversedMessage: function () {
//                var c=document.getElementById("myCanvas");
//                var ctx=c.getContext("2d");
//                ctx.fillStyle="#FF0000";
//                ctx.fillRect(0,0,300,300);
//                ctx.fillStyle="#FFFF00";
//                ctx.font=this.font_size + "px " + this.font;
//                ctx.textAlign="center";
//                ctx.fillText(this.text,150,150);
//                return this.font_size + " " + this.font;
//            }
//        }
//});
//        \App\Http\Models\Admin\User::create([
//            'name' => 'asd',
//            'email' => 'asd@asd.com',
//            'password' => bcrypt('asdasd'),
//        ]);
//
        $this->call(TypeSeeder::class);
//        $this->call(IconSeeder::class);
//        $this->call(TempSeeder::class);
//        $this->call(MapSeeder::class);
//        $this->call(FontSeeder::class);
    }
}
