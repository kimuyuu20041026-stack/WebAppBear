<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'User1',
            'email' => 'test1@example.com',
            'password' => 'password',
            'address' => '住所1',
            'role' => 'user',
        ]);

        User::create([
            'name' => 'User2',
            'email' => 'test2@example.com',
            'password' => 'password',
            'address' => '住所2',
            'role' => 'municipality',
        ]);

        User::create([
            'name' => 'User3',
            'email' => 'test3@example.com',
            'password' => 'password',
            'address' => '住所3',
            'role' => 'admin',
        ]);
    }
}
