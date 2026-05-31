<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_dokumen_kategori', function (Blueprint $table) {
            $table->id();
            $table->integer('sort')->default(0);
            $table->boolean('status')->default(1);
            $table->string('nama');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_dokumen_kategori');
    }
};
