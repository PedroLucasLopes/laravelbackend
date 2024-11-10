<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tasks')->insert([
            'name' => 'Create a backend',
            'description' => 'Creating a backend for Jedis',
            'is_done' => false,
        ]);
    }
}
