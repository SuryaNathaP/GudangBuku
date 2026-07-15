<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PeminjamansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $peminjamans = [
            [
                'id' => 1,
                'siswa_id' => 1,
                'buku_id' => 1,
                'user_id' => 1,
                'tanggal_pinjam' => '1945-01-01',
                'tanggal_kembali' => '2045-01-02',
                'status' => 'dipinjam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'siswa_id' => 2,
                'buku_id' => 2,
                'user_id' => 2,
                'tanggal_pinjam' => '2001-09-11',
                'tanggal_kembali' => '2026-02-05',
                'status' => 'dikembalikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'siswa_id' => 3,
                'buku_id' => 3,
                'user_id' => 3,
                'tanggal_pinjam' => '2025-02-05',
                'tanggal_kembali' => '2026-02-05',
                'status' => 'dikembalikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'siswa_id' => 4,
                'buku_id' => 4,
                'user_id' => 4,
                'tanggal_pinjam' => '2023-02-05',
                'tanggal_kembali' => '2026-02-05',
                'status' => 'dikembalikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'siswa_id' => 5,
                'buku_id' => 5,
                'user_id' => 5,
                'tanggal_pinjam' => '2022-01-01',
                'tanggal_kembali' => '2067-02-05',
                'status' => 'dipinjam',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('peminjamans')->insert($peminjamans);
    }
}
