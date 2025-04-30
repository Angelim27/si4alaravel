<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void //menambah dan mengubah pengaturan kolom
    {
        Schema::create('fakultas', function (Blueprint $table) {
            $table->id(); // PK, auto increment, bigint
            $table->string('nama', 50);
            $table->string('singkatan', 5);
            $table->string('dekan', 30);
            $table->string('wakil_dekan', 30);
            $table->timestamps(); // 2 kolom : created at dan updated at kolom
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void //mengahpus kolom atau tabel
    {
        Schema::dropIfExists('fakultas');
    }
};
