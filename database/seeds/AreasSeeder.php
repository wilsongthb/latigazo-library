<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use \DB as DB;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        
        // areas 
        DB::table('areas')->insert([
            ['name' => 'INGENIERAS'],
            ['name' => 'SOCIALES'],
            ['name' => 'BIOMEDICAS'],
            
        ]);
    }
}
