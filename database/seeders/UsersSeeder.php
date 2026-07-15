<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
        [
            'id' => 1,
            'name' => 'Natha',
            'email' => 'natha@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'id' => 2,
            'name' => 'Surya',
            'email' => 'surya@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'petugas',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ];  
    
    DB::table('users')->insert($users);
    }
}

