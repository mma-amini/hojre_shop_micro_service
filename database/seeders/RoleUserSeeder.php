<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('role_user')->insert([
            'user_id'    => 'b6b7a78d-70f3-467a-afb8-18c0661cb0c9',
            'role_id' => 'فروشگاه',
        ]);
    }
}
