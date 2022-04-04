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
            'id' => "197bb9a7-61df-45a1-9361-7c3bba14acfe",
            'first_name' => 'محمد',
            'last_name' => 'مباشر امینی',
            'username' => '09366707983',
            'password' => Hash::make("123456"),
        ]);
    }
}
