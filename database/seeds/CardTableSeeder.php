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
        $i = 0;
        while($i < 100) {
            DB::table('cards')->insert([
                'name' => str_random(10),
                'email' => str_random(10) . '@gmail.com',
                'password' => 'secret',
            ]);
            $i = $i + 1;
        }
    }
}