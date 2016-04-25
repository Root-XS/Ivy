<?php

require_once 'BaseSeeder.php';

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run()
    {
        $this->call(AbilitiesTableSeeder::class);
    }
}
