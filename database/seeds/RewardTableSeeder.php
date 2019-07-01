<?php

use Illuminate\Database\Seeder;

class RewardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rewards')->insert([
            'book_name'=> '计算机科学概论',
            'book_price'=> 30,
            'description'=> "计算机科学概论",
            'issuer_id' => 0,
            'status' => 'issued',
        ]);
        DB::table('rewards')->insert([
            'book_name'=> '计算机程序设计艺术',
            'book_price'=> 33,
            'description'=> "《计算机程序设计艺术》系列是公认的计算机科学领域经典之作，深入阐述了程序设计理论，对计算机领域的发展有着极为深远的影响。本书是该系列的第 1 卷，讲解基本算法，其中包含了其他各卷都需用到的基本内容。本卷从基本概念开始，然后讲述信息结构，并辅以大量的习题及答案。",
            'issuer_id' => 0,
            'applier_id'=>1,
            'status' => 'applied',
        ]);
        DB::table('rewards')->insert([
            'book_name'=> '白宫岁月',
            'book_price'=> 130,
            'description'=> "《白宫岁月》详细记录了基辛格作为总统国家安全助理在尼克松政府任职的头四年（1969-1973）。可以毫不夸张地说，它是来自尼克松政府最重要的书籍之一。",
            'issuer_id' => 0,
            'status' => 'issued'
        ]);
    }
}
