<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('master_banner', function (Blueprint $table) {
            $table->enum('type', ['home', 'halaman'])->default('home')->after('id');
            $table->string('page')->nullable()->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('master_banner', function (Blueprint $table) {
            $table->dropColumn(['type', 'page']);
        });
    }
};
