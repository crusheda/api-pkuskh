<?php

use Illuminate\Database\Seeder;

class RekamMedikTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rekammedik')->insert([
            'name' => 'Rekam Medik',
            'email' => 'rekammedik@pkuskh.com',
            'password' => bcrypt('rekammedik')
        ]);
    }
}
