<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 0;
        DB::table('orders')->insert([
            'book_id'=> 2,
            'buyer_id'=> 0,
            'seller_id'=> 3,
            'address' => 'Nnajing Road #3-984',
            'type' => 'face-to-face',
            'status' => 'created'
        ]);
        DB::table('orders')->insert([
            'book_id'=> 1,
            'buyer_id'=> 0,
            'seller_id'=> 3,
            'address' => 'Nnajing Road #3-984',
            'type' => 'face-to-face',
            'status'=>'confirmed'
        ]);
        DB::table('orders')->insert([
            'book_id'=> 3,
            'buyer_id'=> 0,
            'seller_id'=> 1,
            'address' => 'Nnajing Road #3-984',
            'type' => 'face-to-face',
            'status' => 'finished'
        ]);
        DB::table('orders')->insert([
            'book_id'=> 0,
            'buyer_id'=> 3,
            'seller_id'=> 0,
            'address' => 'Nnajing Road #3-984',
            'type' => 'face-to-face',
            'status' => 'finished'
        ]);
    }

}
