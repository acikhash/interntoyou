<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Carbon;

class JobFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('job_fields')->insert([[
            'description' => 'Information Technology',
            'created_by' => '1',
            'created_at' => now(),
        ], [
            'description' => 'Business',
            'created_by' => '1',
            'created_at' => now(),
        ], [
            'description' => 'Accounting',
            'created_by' => '1',
            'created_at' => now(),
        ],]);
    }
}
