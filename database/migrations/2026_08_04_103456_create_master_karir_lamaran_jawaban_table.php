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
        Schema::create('master_karir_lamaran_jawaban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lamaran_id')->constrained('master_karir_lamaran')->onDelete('cascade');
            $table->foreignId('karir_form_field_id')->nullable()->constrained('master_karir_form_field')->nullOnDelete();
            $table->string('label_snapshot');
            $table->text('value')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_karir_lamaran_jawaban');
    }
};
