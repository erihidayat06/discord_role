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
            $table->string('no_tlp')->nullable();
            $table->string('password')->nullable(); // Tidak nullable untuk keamanan
            $table->date('expired')->nullable();
            $table->boolean('discord_active')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['no_tlp', 'password', 'expired', 'discord_active']); // Hapus semua kolom yang ditambahkan
        });
    }
};
