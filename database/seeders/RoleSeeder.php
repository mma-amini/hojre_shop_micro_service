<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('roles')->insert([
            'id' => '303d0021-5813-4971-b39e-2df1f494c570',
            'title' => 'مشتری',
        ]);
        DB::table('roles')->insert([
            'id' => 'b6b7a78d-70f3-467a-afb8-18c0661cb0c9',
            'title' => 'فروشگاه',
        ]);
        DB::table('roles')->insert([
            'id' => 'd5b1578e-db8e-4657-8186-4691e885ec81',
            'title' => 'مدیر',
        ]);
    }
}
