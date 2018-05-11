<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CardTableSeeder extends Seeder{
    /**
     * 运行数据库填充
     *
     * @return void
     */
    public function run()
    {
        DB::table('cards')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => 'secret',
        ]);
    }
}