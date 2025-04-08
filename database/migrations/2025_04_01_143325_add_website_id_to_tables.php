<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        // Pastikan ID 1 tersedia di tabel `websites` (jika belum ada)
        DB::table('websites')->updateOrInsert(
            ['id' => 1],
            ['domain' => 'default.example.com', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()]
        );

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

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (!Schema::hasColumn($tableName, 'website_id')) {
                    $table->unsignedBigInteger('website_id')->default(1)->after('id');
                }
            });

            // Tambahkan foreign key constraint di luar closure untuk menghindari error saat table belum update
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                $foreignKeyName = "{$tableName}_website_id_foreign";

                // Cek dulu kalau belum ada foreign key
                if (!collect(Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys($tableName))
                    ->pluck('name')->contains($foreignKeyName)) {
                    $table->foreign('website_id')
                        ->references('id')
                        ->on('websites')
                        ->onDelete('cascade');
                }
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

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropForeign([$table->getTable() . '_website_id_foreign']);
                $table->dropColumn('website_id');
            });
        }
    }
};
