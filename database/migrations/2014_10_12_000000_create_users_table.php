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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('discord_id')->unique()->nullable();  // ID unik dari Discord
            $table->string('name')->nullable();  // Nama pengguna Discord
            $table->string('avatar')->nullable();  // URL avatar pengguna Discord
            $table->string('email')->nullable();  // Email pengguna Discord (jika tersedia)
            $table->string('is_admin')->default('1');  // Nama pengguna Discord
            $table->string('token')->nullable();  // Token akses Discord (jika diperlukan)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
