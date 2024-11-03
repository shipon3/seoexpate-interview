<?php

namespace Database\Seeders;

use App\Enum\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'user_type' => UserType::ADMIN,
                'name' => 'Shipon Mondal',
                'email' => 'engshipon3@gmail.com',
                'password' => Hash::make("engshipon3@gmail.com"),
                'avater' => null,
                'id' => 1
            ],
            [
                'user_type' => UserType::STAFF,
                'name' => 'Ripon Mondal',
                'email' => 'ripon@gmail.com',
                'password' => Hash::make(123456),
                'avater' => null,
                'id' => 2
            ],
            [
                'user_type' => UserType::STAFF,
                'name' => 'Atik Mondal',
                'email' => 'atik@gmail.com',
                'password' => Hash::make(123456),
                'avater' => null,
                'id' => 3
            ],
            [
                'user_type' => UserType::STAFF,
                'name' => 'Saiful Islam',
                'email' => 'saiful@gmail.com',
                'password' => Hash::make(123456),
                'avater' => null,
                'id' => 4
            ],
            [
                'user_type' => UserType::STAFF,
                'name' => 'Ovi Islam',
                'email' => 'ovi@gmail.com',
                'password' => Hash::make(123456),
                'avater' => null,
                'id' => 5
            ],
        ];

        // Insert data into the "divisions" table
        DB::table('users')->insert($user);

        // run seed by cmd:  php artisan db:seed --class=UserSeeder
    }
}
