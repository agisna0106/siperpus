<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('Id');
        // DB::table('users')->insert(
        //     [
        //         'npm' => '5520123111',
        //         'username' => 'agiiis0106',
        //         'first_name' => 'Agisna',
        //         'last_name' => 'Rizkan',
        //         'email' => 'agiiis0106@gmail.com',
        //         'password' => Hash::make('agisna123')
        //     ]
        // );

        for($i=0; $i<50; $i++) {
            $angkatan = rand(22,25);
            $urutan = 10+$i;
            DB::table('users')->insert(
                [
                    'npm' => "55201{$angkatan}0{$urutan}",
                    'username' => $faker->userName(),
                    'first_name' => $faker->firstName(),
                    'last_name' => $faker->lastName(),
                    'email' => $faker->email(),
                    'password' => bcrypt('password123')
                ]
            );
        }
    }
}
