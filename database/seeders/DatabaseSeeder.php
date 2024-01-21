<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            'name' => 'internToYou.com',
            'ssm_no' => fake()->companySuffix() . fake()->numberBetween(0, 1000),
            'website' => fake()->url(),
            'location' => fake()->address(),
            'size' => fake()->numberBetween(10, 1000),
            'created_at' => now(),
            'created_by' => '1',
        ]);
        DB::table('users')->insert([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('password'),
            'role' => '1',
            'company_id' => '1',
            'created_at' => now(),
            'created_by' => '1',
        ]);
        $this->call([
            JobFieldSeeder::class,
            CompanySeeder::class,
            PostSeeder::class,
        ]);
        DB::table('users')->insert([
            'name' => 'testCompanies',
            'email' => 'testCompanies@gmail.com',
            'password' => Hash::make('password'),
            'role' => '2',
            'company_id' => '2',
            'created_at' => now(),
            'created_by' => '1',
        ]);
    }
}
