<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       User::create([
        'name' => 'nyi waing chit',
        'email' => 'nyiwaingchit@gmail.com',
        'phone'=> '09242003',
        'address'=>'Myeik',
        'role' => 'admin',
        'password'=> Hash::make('nyi242003')
       ]);
    }
}
