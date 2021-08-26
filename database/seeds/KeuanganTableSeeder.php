<?php

use Illuminate\Database\Seeder;

class KeuanganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('keuangan')->insert([
            'name' => 'Keuangan',
            'email' => 'keuangan@pkuskh.com',
            'password' => bcrypt('keuangan')
        ]);
    }
}
