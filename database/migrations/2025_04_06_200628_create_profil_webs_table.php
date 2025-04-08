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
        Schema::create('profil_webs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_website')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_title')->nullable(); // Tambahan logo title

            // Bunny Stream
            $table->string('bunny_stream_library_id')->nullable();
            $table->string('bunny_stream_api_key')->nullable();
            $table->string('bunny_stream_watermark_url')->nullable();

            // Cloudflare
            $table->string('cloudflare_site_key')->nullable();
            $table->string('cloudflare_secret_key')->nullable();

            // Midtrans
            $table->string('midtrans_merchant_id')->nullable();
            $table->string('midtrans_client_key')->nullable();
            $table->string('midtrans_server_key')->nullable();
            $table->string('midtrans_url')->nullable();
            $table->boolean('midtrans_is_production')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_webs');
    }
};
