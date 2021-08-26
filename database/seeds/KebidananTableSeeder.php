<?php

use Illuminate\Database\Seeder;

class KebidananTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kebidanan')->insert([
            'name' => 'Kebidanan',
            'email' => 'kebidanan@pkuskh.com',
            'password' => bcrypt('kebidanan')
        ]);
    }
}
