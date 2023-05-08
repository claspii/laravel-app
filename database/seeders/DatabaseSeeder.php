<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Account::create([
            'username' => 'Baole',
            'email' => 'Baole@example.com',
            'password'=>Hash::make('123456'),
            'id_role'=>1
        ]);
        \App\Models\Account::create([
            'username' => 'HoangCong',
            'email' => 'HoangCong@example.com',
            'password'=>Hash::make('123456'),
            'id_role'=>2
        ]);
        \App\Models\Account::create([
            'username' => 'HoaiTrung',
            'email' => 'HoaiTrung@example.com',
            'password'=>Hash::make('123456'),
            'id_role'=>3
        ]);
        \App\Models\Account::create([
            'username' => 'Viet',
            'email' => 'Viet@example.com',
            'password'=>Hash::make('123456'),
            'id_role'=>4
        ]);
    }
}
