<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class SiswasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswas = [
            [
                'id' => 1,
                'nama' => 'Natha',
                'nis' => '123456789',
                'kelas' => 'X',
                'jurusan' => 'PPLG',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama' => 'Surya',
                'nis' => '987654322',
                'kelas' => 'X',
                'jurusan' => 'PPLG',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama' => 'Bagus',
                'nis' => '987654323',
                'kelas' => 'X',
                'jurusan' => 'PPLG',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nama' => 'Maja',
                'nis' => '987654324',
                'kelas' => 'X',
                'jurusan' => 'PPLG',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nama' => 'Wahyu',
                'nis' => '987654325',
                'kelas' => 'X',
                'jurusan' => 'PPLG',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('siswas')->insert($siswas);
    }
}
