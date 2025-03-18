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
        Schema::table('keanggotaans', function (Blueprint $table) {
            $table->string('text_title')->nullable();
            $table->boolean('akses_role')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keanggotaans', function (Blueprint $table) {
            $table->dropColumn(['text_title', 'akses_role']);
        });
    }
};
