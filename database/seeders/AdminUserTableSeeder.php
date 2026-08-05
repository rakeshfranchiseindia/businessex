<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin_user')->insert([
            'admin_id' => 1,
            'admin_name' => 'Rajesh Kumar',
            'admin_email' => 'admin@businessex.com',
            'admin_password' => '$2y$12$hashedpasswordseeddata1234567890123456789',
            'remember_token' => 'abcdefghijklmnopqrstuvwxyz1234567890abc',
            'admin_dept' => '1',
            'admin_role' => 1,
            'admin_is_active' => 0
        ]);

        DB::table('admin_user')->insert([
            'admin_id' => 2,
            'admin_name' => 'Priya Sharma',
            'admin_email' => 'john.doe@example.com',
            'admin_password' => '$2y$12$hashedpasswordseeddata1234567890123456789',
            'remember_token' => 'abcdefghijklmnopqrstuvwxyz1234567890abc',
            'admin_dept' => '2',
            'admin_role' => 2,
            'admin_is_active' => 1
        ]);

        DB::table('admin_user')->insert([
            'admin_id' => 3,
            'admin_name' => 'Amit Patel',
            'admin_email' => 'priya.sharma@example.com',
            'admin_password' => '$2y$12$hashedpasswordseeddata1234567890123456789',
            'remember_token' => 'abcdefghijklmnopqrstuvwxyz1234567890abc',
            'admin_dept' => '3',
            'admin_role' => 3,
            'admin_is_active' => 0
        ]);

    }
}