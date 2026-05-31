<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_dokumen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('master_dokumen_kategori')->onDelete('cascade');
            $table->integer('sort')->default(0);
            $table->boolean('status')->default(1);
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('file')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_dokumen');
    }
};
