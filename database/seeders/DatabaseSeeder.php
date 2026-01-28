<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        // User::create([
        //     'first_name' => 'Suad',
        //     'last_name' => 'Kucalović',
        //     'email' => 'test@test.com',
        //     'phone' => '+387 66 699-839',
        //     'password' => Hash::make('test1234'),
        //     'role' => 1
        // ]);
    }
}
