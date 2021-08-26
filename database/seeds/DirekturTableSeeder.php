<?php

use Illuminate\Database\Seeder;

class DirekturTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('direktur')->insert([
            'name' => 'Direktur',
            'email' => 'direktur@pkuskh.com',
            'password' => bcrypt('direktur')
        ]);
    }
}
