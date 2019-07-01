<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 0;
        $names = [
            '小陈','小吴','Dave', 'Tina', 'John', 'Andy', 'Steve','Angelia'
        ];
        foreach($names as $name) {
            DB::table('users')->insert([
                'name' => $name,
                'email' => $name . '@gmail.com',
                'password' => 'secret',
                'api_token' => 'token'.$i,
            ]);
            $i = $i + 1;
        }
        //
    }
}

