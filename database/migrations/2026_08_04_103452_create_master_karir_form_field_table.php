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
        Schema::create('master_karir_form_field', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karir_id')->constrained('master_karir')->onDelete('cascade');
            $table->string('label');
            $table->string('type');
            $table->text('options')->nullable();
            $table->boolean('is_required')->default(true);
            $table->integer('sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_karir_form_field');
    }
};
