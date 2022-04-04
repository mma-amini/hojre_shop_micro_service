<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            'first_name' => 'محمد',
            'last_name' => 'مباشر امینی',
            'username' => '09366707983',
            'password' => Hash::make("123456"),
        ]);
    }
}
