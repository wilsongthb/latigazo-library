<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use \DB as DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        
        // usuario base

        DB::table('users')->insert([
            'name' => 'root',
            'email' => 'root@r.r',
            'password' => bcrypt('root')
        ]);

        // usuarios varios
        $users = [];
        for($i = 0; $i < 100; $i++){
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('secret')
            ];
        }
        DB::table('users')->insert($users);
    }
}
