<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique(); // ID unik untuk order
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke user
            $table->foreignId('keanggotaan_id')->constrained()->onDelete('cascade'); // Relasi ke keanggotaan
            $table->decimal('amount', 15, 2); // Total harga
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending'); // Status order
            $table->timestamp('paid_at')->nullable(); // Waktu pembayaran jika sudah lunas
            $table->string('type')->nullable(); // Waktu pembayaran jika sudah lunas
            $table->string('token')->nullable(); // Waktu pembayaran jika sudah lunas
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
