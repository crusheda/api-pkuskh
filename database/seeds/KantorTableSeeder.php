<?php

use Illuminate\Database\Seeder;

class KantorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kantor')->insert([
            'name' => 'Kantor',
            'email' => 'kantor@pkuskh.com',
            'password' => bcrypt('kantor')
        ]);
    }
}
