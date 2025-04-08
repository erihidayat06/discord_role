<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateWebsiteIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Update `website_id` ke 3 pada semua tabel
        DB::table('guilds')->update(['website_id' => 3]);
        DB::table('kategoris')->update(['website_id' => 3]);
        DB::table('keanggotaans')->update(['website_id' => 3]);
        DB::table('kelas')->update(['website_id' => 3]);
        DB::table('looks')->update(['website_id' => 3]);
        DB::table('moduls')->update(['website_id' => 3]);
        DB::table('orders')->update(['website_id' => 3]);
        DB::table('periods')->update(['website_id' => 3]);
        DB::table('pixels')->update(['website_id' => 3]);
        DB::table('researchs')->update(['website_id' => 3]);
        DB::table('users')->update(['website_id' => 3]);
        DB::table('user_roles')->update(['website_id' => 3]);

        // Menambahkan log jika perlu untuk memverifikasi update
        $this->command->info('Website ID updated to 3 for all specified tables');
    }
}
