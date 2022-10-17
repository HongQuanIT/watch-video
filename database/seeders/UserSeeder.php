<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

// possion 1
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10)->create();

        User::create([
            'email' => "admin@gmail.com",
            'avatar' => 'https://source.unsplash.com/random',
            'first_name' => "Test",
            'last_name' => "Admin",
            'password' => Hash::make("password"),
            'status' => "active",
            'remember_token' => null,
        ]);


    }
}
