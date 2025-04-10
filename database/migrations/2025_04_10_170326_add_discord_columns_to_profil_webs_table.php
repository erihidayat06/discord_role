<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('profil_webs', function (Blueprint $table) {
            $table->string('discord_client_id')->nullable();
            $table->string('discord_client_secret')->nullable();
            $table->string('discord_bot_token')->nullable();
        });
    }

    public function down()
    {
        Schema::table('profil_webs', function (Blueprint $table) {
            $table->dropColumn([
                'discord_client_id',
                'discord_client_secret',
                'discord_bot_token',
            ]);
        });
    }
};
