<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FakeDataSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            'id'         => "197bb9a7-61df-45a1-9361-7c3bba14acfe",
            'first_name' => 'محمد',
            'last_name'  => 'مباشر امینی',
            'username'   => '09366707983',
            'password'   => Hash::make("123456"),
        ]);
        
        DB::table('roles')->insert([
            'id'    => '303d0021-5813-4971-b39e-2df1f494c570',
            'title' => 'مشتری',
        ]);
        DB::table('roles')->insert([
            'id'    => 'b6b7a78d-70f3-467a-afb8-18c0661cb0c9',
            'title' => 'فروشگاه',
        ]);
        DB::table('roles')->insert([
            'id'    => 'd5b1578e-db8e-4657-8186-4691e885ec81',
            'title' => 'مدیر',
        ]);
        
        DB::table('role_user')->insert([
            'user_id' => '197bb9a7-61df-45a1-9361-7c3bba14acfe',
            'role_id' => 'b6b7a78d-70f3-467a-afb8-18c0661cb0c9',
        ]);
        
        DB::table('shops')->insert([
            'id'               => 'abc76d9c-1778-469b-9621-0316e713f59a',
            'user_id'          => '197bb9a7-61df-45a1-9361-7c3bba14acfe',
            'shop_name'        => 'اروند آزاد',
            'shop_state'       => 'dsfsdf',
            'shop_address'     => 'dsfhghjghjjhsdf',
            'shop_postal_code' => '213548794564',
            'shop_phone'       => '02122444798',
        ]);
    }
}
