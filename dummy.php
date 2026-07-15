<?php
use App\Models\Siswa;
use App\Models\Buku;
use App\Models\peminjaman;
use App\Models\kategori;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

try {
    $now = Carbon::now();

    // 1. Kategori
    $katId = 999;
    DB::table('kategoris')->updateOrInsert(
        ['id' => $katId],
        ['nama_kategori' => 'Fiksi', 'keterangan' => 'Buku cerita Fiksi remaja', 'created_at' => $now, 'updated_at' => $now]
    );

    // 2. Buku
    $bukuId1 = rand(10000, 50000);
    $bukuId2 = rand(50001, 99999);
    DB::table('bukus')->insert([
        ['id' => $bukuId1, 'judul' => 'Laskar Pelangi V2', 'penulis' => 'Andrea Hirata', 'tahun_terbit' => '2005', 'stok' => 5, 'kategori_id' => $katId, 'created_at' => $now, 'updated_at' => $now],
        ['id' => $bukuId2, 'judul' => 'Bumi Manusia V2', 'penulis' => 'Pramoedya', 'tahun_terbit' => '1980', 'stok' => 10, 'kategori_id' => $katId, 'created_at' => $now, 'updated_at' => $now]
    ]);

    // 3. Siswa
    $siswa1 = Siswa::create(['nama' => 'Rahmat Hidayat', 'nis' => '10001', 'kelas' => 'X', 'jurusan' => 'PPLG 1']);
    $siswa2 = Siswa::create(['nama' => 'Nayla Putri', 'nis' => '10002', 'kelas' => 'XII', 'jurusan' => 'DKV 1']);

    // 4. Peminjaman
    $user = User::first();
    
    peminjaman::create([
        'siswa_id' => $siswa1->id,
        'buku_id' => $bukuId1,
        'user_id' => $user->id ?? 1,
        'tanggal_pinjam' => $now->copy()->subDays(10)->toDateString(),
        'tanggal_kembali' => $now->copy()->subDays(3)->toDateString(), // Terlambat 3 hari
        'status' => 'dipinjam',
        'jumlah_buku' => 2,
        'denda_lunas' => false
    ]);

    peminjaman::create([
        'siswa_id' => $siswa2->id,
        'buku_id' => $bukuId2,
        'user_id' => $user->id ?? 1,
        'tanggal_pinjam' => $now->copy()->subDays(2)->toDateString(),
        'tanggal_kembali' => $now->copy()->addDays(5)->toDateString(), // Masih aktif
        'status' => 'dipinjam',
        'jumlah_buku' => 1,
        'denda_lunas' => false
    ]);

    echo "SUCCESS\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
