<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    public $incrementing = false;

    protected $fillable = [
        'id',
        'judul',
        'penulis',
        'tahun_terbit',
        'kategori_id',
        'stok',
        'rak',
        'timestamps'
    ];

    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'kategori_id');
    }
}