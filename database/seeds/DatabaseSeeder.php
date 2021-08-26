<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // unchecklist after used

        $this->call(AdminTableSeeder::class);
        $this->call(OtherRoleTableSeeder::class);
        $this->call(DirekturTableSeeder::class);
        $this->call(FarmasiTableSeeder::class);
        $this->call(KantorTableSeeder::class);
        $this->call(KeuanganTableSeeder::class);
        $this->call(KebidananTableSeeder::class);
        $this->call(RekamMedikTableSeeder::class);
    }
}
