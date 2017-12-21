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
        // DB::table('users')->insert()
        $users = [];

        for($i = 0; $i < 100; $i++){
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('secret')
            ];
        }

        // dd($users);

        DB::table('users')->insert($users);
    }
}
