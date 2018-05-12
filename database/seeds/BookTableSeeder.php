<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BookTableSeeder extends Seeder{
    /**
     * 运行数据库填充
     *
     * @return void
     */
    public function run()
    {
        $i = 0;
        while($i < 100) {
            DB::table('books')->insert([
                'name' => str_random(10),
                'author' => str_random(10),
                'press' => str_random(10),
                'quantity' => 4,
                'stock' => 4
            ]);
            $i = $i + 1;
        }
    }
}