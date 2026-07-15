<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    use HasFactory;
    // id sekarang auto-increment, jadi tidak perlu diisi manual
    public $incrementing = true;

    protected $table = 'peminjamans';

    protected $fillable = [
        'siswa_id',
        'buku_id',
        'jumlah_buku',
        'user_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'denda_lunas'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}