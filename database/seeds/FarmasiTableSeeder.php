<?php

use Illuminate\Database\Seeder;

class FarmasiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('farmasi')->insert([
            'name' => 'Farmasi',
            'email' => 'farmasi@pkuskh.com',
            'password' => bcrypt('farmasi')
        ]);
    }
}
