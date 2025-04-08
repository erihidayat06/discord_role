<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        $tables = [
            'guilds',
            'kategoris',
            'keanggotaans',
            'kelas',
            'looks',
            'moduls',
            'orders',
            'periods',
            'pixels',
            'researchs',
            'users',
            'user_roles'
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->unsignedBigInteger('website_id')->after('id')->nullable();
                $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        $tables = [
            'guilds',
            'kategoris',
            'keanggotaans',
            'kelas',
            'looks',
            'moduls',
            'orders',
            'periods',
            'pixels',
            'researchs',
            'users',
            'user_roles'
        ];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropForeign(["website_id"]);
                $table->dropColumn("website_id");
            });
        }
    }
};
