<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * - Adds jumlah_buku column (default 1)
     * - Changes id from manual bigInteger to auto-increment bigIncrements
     */
    public function up(): void
    {
        // Step 1: Add jumlah_buku column
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->unsignedInteger('jumlah_buku')->default(1)->after('buku_id');
        });

        // Step 2: Change primary key to auto-increment
        // Drop the existing primary key, add AUTO_INCREMENT
        DB::statement('ALTER TABLE peminjamans MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->dropColumn('jumlah_buku');
        });

        // Revert to manual bigint primary key
        DB::statement('ALTER TABLE peminjamans MODIFY id BIGINT NOT NULL');
    }
};
