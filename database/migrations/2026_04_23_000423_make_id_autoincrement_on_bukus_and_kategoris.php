<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Ubah kolom id di tabel bukus dan kategoris menjadi AUTO_INCREMENT.
     * Karena SQLite tidak support ALTER COLUMN, kita modifikasi via raw SQL untuk MySQL.
     */
    public function up(): void
    {
        // Ubah bukus.id menjadi BIGINT AUTO_INCREMENT
        DB::statement('ALTER TABLE bukus MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');

        // Ubah kategoris.id menjadi BIGINT AUTO_INCREMENT
        DB::statement('ALTER TABLE kategoris MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
    }

    public function down(): void
    {
        // Kembalikan ke non-auto-increment (hati-hati: data tidak terhapus)
        DB::statement('ALTER TABLE bukus MODIFY id BIGINT NOT NULL');
        DB::statement('ALTER TABLE kategoris MODIFY id BIGINT NOT NULL');
    }
};
