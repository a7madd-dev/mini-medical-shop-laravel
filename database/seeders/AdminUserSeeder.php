<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        if (!User::where('email', 'a7madd5111@gmail.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'a7madd5111@gmail.com',
                'password' => Hash::make('6600'),
                'remember_token' => Str::random(10),
                'role' => 'admin',
            ]);
        }
    }
}
