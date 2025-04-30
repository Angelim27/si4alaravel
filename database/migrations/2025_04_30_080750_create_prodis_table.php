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
        Schema::create('prodi', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->string('singkatan', 2);
            $table->string('kaprodi', 30);
            $table->string('sekretaris', 30);
            $table->foreignId('fakultas')->constrained('fakultas')->onDelete('restrict')
            ->onUpfate('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi');
    }
};
