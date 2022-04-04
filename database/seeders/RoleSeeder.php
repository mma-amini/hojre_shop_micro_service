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
            'title' => 'مشتری',
        ]);
        DB::table('roles')->insert([
            'title' => 'فروشگاه',
        ]);
        DB::table('roles')->insert([
            'title' => 'مدیر',
        ]);
    }
}
