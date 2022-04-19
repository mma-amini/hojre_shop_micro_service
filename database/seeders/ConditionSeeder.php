<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_conditions')->insert([
            'status_code' => 0,
            'title_fa' => 'مشتری سفارش داد',
            'title_en' => 'Customer ordered',
            'const_title' => 'CUSTOMER_ORDERED',
        ]);

        DB::table('order_conditions')->insert([
            'status_code' => 1,
            'title_fa' => 'در انتظار پرداخت آنلاین',
            'title_en' => 'Waiting for online payment',
            'const_title' => 'WAITING_FOR_ONLINE_PAYMENT',
        ]);

        DB::table('order_conditions')->insert([
            'status_code' => 9,
            'title_fa' => 'مشتری تحویل گرفت',
            'title_en' => 'Customer received',
            'const_title' => 'CUSTOMER_RECIEVED',
        ]);

        DB::table('order_conditions')->insert([
            'status_code' => 10,
            'title_fa' => 'مشتری رای و نظر داد',
            'title_en' => 'The customer voted and commented',
            'const_title' => 'THE_CUSTOMER_VOTED_AND_COMMENTED',
        ]);

        DB::table('order_conditions')->insert([
            'status_code' => 22,
            'title_fa' => 'صف پیک',
            'title_en' => 'Courier line',
            'const_title' => 'COURIER_LINE',
        ]);

        DB::table('order_conditions')->insert([
            'status_code' => 23,
            'title_fa' => 'قفل سفارش',
            'title_en' => 'Order lock',
            'const_title' => 'ORDER_LOCK',
        ]);

        DB::table('order_conditions')->insert([
            'status_code' => 24,
            'title_fa' => 'پیک سفارش را تحویل گرفت',
            'title_en' => 'The courier received the order',
            'const_title' => 'THE_COURIER_RECIEVED_THE_ORDER',
        ]);

        DB::table('order_conditions')->insert([
            'status_code' => 25,
            'title_fa' => 'پیک به فروشگاه رسید',
            'title_en' => 'The courier arrived at the store',
            'const_title' => 'THE_COURIER_ARRIVED_AT_THE_STORE',
        ]);

        DB::table('order_conditions')->insert([
            'status_code' => 26,
            'title_fa' => 'پردازش در انبار مبدا',
            'title_en' => 'Processing in the source warehouse',
            'const_title' => 'PROCESSING_IN_THE_SOURCE_WAREHOUSE',
        ]);

        DB::table('order_conditions')->insert([
            'status_code' => 52,
            'title_fa' => 'فروشگاه سفارش را مشاهده کرد',
            'title_en' => 'The store saw the order',
            'const_title' => 'THE_STORE_SAW_THE_ORDER',
        ]);

        DB::table('order_conditions')->insert([
            'status_code' => 53,
            'title_fa' => 'فروشگاه سفارش را تایید کرد',
            'title_en' => 'The store confirmed the order',
            'const_title' => 'THE_STORE_CONFIRMED_THE_ORDER',
        ]);

        DB::table('order_conditions')->insert([
            'status_code' => -1,
            'title_fa' => 'لغو توسط مشتری',
            'title_en' => 'Cancel by customer',
            'const_title' => 'CANCEL_BY_CUSTOMER',
        ]);

        DB::table('order_conditions')->insert([
            'status_code' => -2,
            'title_fa' => 'لغو توسط سیستم',
            'title_en' => 'Cancel by system',
            'const_title' => 'CANCLE_BY_SYSTEM',
        ]);

        DB::table('order_conditions')->insert([
            'status_code' => -22,
            'title_fa' => 'لغو توسط پیک',
            'title_en' => 'Cancel by courier',
            'const_title' => 'CANCEL_BY_COURIER',
        ]);

        DB::table('order_conditions')->insert([
            'status_code' => -41,
            'title_fa' => 'لغو توسط پشتیبانی',
            'title_en' => 'Cancel by support',
            'const_title' => 'CANCLE_BY_SUPPORT',
        ]);

        DB::table('order_conditions')->insert([
            'status_code' => -53,
            'title_fa' => 'فروشگاه سفارش را لغو کرد',
            'title_en' => 'The store canceled the order',
            'const_title' => 'THE_STORE_CACELED_THE_ORDER',
        ]);

        DB::table('order_conditions')->insert([
            'status_code' => -54,
            'title_fa' => 'فروشگاه سفارش را تغییر داد',
            'title_en' => 'The store changed the order',
            'const_title' => 'THE_STORE_CHANGED_THE_ORDER',
        ]);

        DB::table('order_conditions')->insert([
            'status_code' => -55,
            'title_fa' => 'فروشگاه سفارش را بعد از تایید لغو کرد',
            'title_en' => 'The store canceled the order after confirmation',
            'const_title' => 'THE_STORE_CACELED_THE_ORDER_AFTER_CONFIRMATION',
        ]);
    }
}
