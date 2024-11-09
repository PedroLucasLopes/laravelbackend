<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'example@example.com')->first()) {
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => 'example@example.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
