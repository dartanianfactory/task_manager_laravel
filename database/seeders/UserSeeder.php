<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'testing_admin',
                'type' => 'admin',
                'email' => 'testing_admin@mail.ru',
                'password' => Hash::make('123123'),
            ],
            [
                'id' => 2,
                'name' => 'testing_customer0',
                'type' => 'customer',
                'email' => 'testing_customer0@mail.ru',
                'password' => Hash::make('123123'),
            ],
            [
                'id' => 3,
                'name' => 'testing_customer1',
                'type' => 'customer',
                'email' => 'testing_customer1@mail.ru',
                'password' => Hash::make('123123'),
            ],
        ]);
    }
}
