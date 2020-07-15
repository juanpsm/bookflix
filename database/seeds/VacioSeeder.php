<?php

use Illuminate\Database\Seeder;

class VacioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $this->call(AdminSeeder::class);
    }
}
