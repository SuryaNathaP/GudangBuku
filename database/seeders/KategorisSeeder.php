<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class KategorisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            [
                'id' => 1,
                'nama_kategori' => 'Novel',
                'keterangan' => 'Novel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama_kategori' => 'Puisi',
                'keterangan' => 'Puisi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama_kategori' => 'Ensiklopedia',
                'keterangan' => 'Ensiklopedia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nama_kategori' => 'Kumpulan Pantun',
                'keterangan' => 'Kumpulan Pantun',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nama_kategori' => 'Kumpulan Cerita',
                'keterangan' => 'Kumpulan Cerita',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('kategoris')->insert($kategoris);
    }
}
