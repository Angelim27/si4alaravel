<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'dosen', 'mahasiswa']) // Menghapus kolom 'role' dari tabel 'users'
                ->default('mahasiswa') // Menambahkan kembali kolom 'role' dengan nilai default 'mahasiswa'
                ->after('email'); // Menempatkan kolom 'role' setelah kolom 'email'  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
