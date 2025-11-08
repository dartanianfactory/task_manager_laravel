<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'id' => 1,
                'name' => 'moke project 1',
                'user_id' => '1',
                'status' => 'planned',
            ],
            [
                'id' => 2,
                'name' => 'moke project 2',
                'user_id' => '1',
                'status' => 'planned',
            ],
        ]);
    }
}
