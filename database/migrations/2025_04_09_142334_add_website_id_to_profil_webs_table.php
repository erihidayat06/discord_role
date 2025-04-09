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
            $table->unsignedBigInteger('website_id')->nullable()->after('id');
        });
    }

    public function down()
    {
        Schema::table('profil_webs', function (Blueprint $table) {
            $table->dropColumn('website_id');
        });
    }
};
