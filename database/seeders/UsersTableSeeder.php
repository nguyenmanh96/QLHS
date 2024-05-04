<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'type' => 'Admin',
        ]);

        DB::table('users')->insert([
            'email' => 'student@gmail.com',
            'password' => bcrypt('qwerty'),
            'type' => 'Student',
        ]);

    }
}
