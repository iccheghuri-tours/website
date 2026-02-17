<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => "Example User",
            'email' => "mail@example.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
            'slug' => "example",
            'points' => 1000,
            'phone' => "+1234567890",
            'image' => "https://picsum.photos/200",
            'completed_tours' => 10,
        ]);
        User::factory()->count(10)->create();
    }
}
