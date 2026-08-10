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
        Schema::create('master_ruang_unduh', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('master_ruang_unduh_kategori')->onDelete('cascade');
            $table->integer('sort')->default(0);
            $table->boolean('status')->default(1);
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('file')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_ruang_unduh');
    }
};
