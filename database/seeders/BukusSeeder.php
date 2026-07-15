<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class BukusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bukus = [
            [
                'id' => 1,
                'judul' => 'Novelku',
                'penulis' => 'Maya',
                'tahun_terbit' => '2022',
                'stok' => '10',
                'kategori_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'judul' => 'Puisiku',
                'penulis' => 'Mama Rayu',
                'tahun_terbit' => '2021',
                'stok' => '15',
                'kategori_id' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'judul' => 'Ensiklopedia',
                'penulis' => '??????',
                'tahun_terbit' => '1945',
                'stok' => '1',
                'kategori_id' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'judul' => 'Kumpulan Pantun',
                'penulis' => 'Jarjit Singh',
                'tahun_terbit' => '2045',
                'stok' => '18',
                'kategori_id' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'judul' => 'Kumpulan Cerita',
                'penulis' => 'AA. Raka Sidan',
                'tahun_terbit' => '2022',
                'stok' => '12',
                'kategori_id' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('bukus')->insert($bukus);
    }
}
