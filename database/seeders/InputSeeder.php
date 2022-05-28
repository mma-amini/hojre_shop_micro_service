<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InputSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('inputs')->insert([
                                        'id'    => 'fa8d9af3-479d-4237-8c1f-7265fcdd11af',
                                        'title' => 'رنگ',
                                        'name'  => 'COLOR',
                                    ]);
        
        DB::table('inputs')->insert([
                                        'id'    => 'f7881269-bfd0-4876-8680-e3ec62daf77c',
                                        'title' => 'ورودی متن',
                                        'name'  => 'TEXT_INPUT',
                                    ]);
        
        DB::table('inputs')->insert([
                                        'id'    => 'd1dfd3b7-fad1-4679-be44-bad2b8458394',
                                        'title' => 'ورودی عدد',
                                        'name'  => 'NUMBER_INPUT',
                                    ]);
        
        DB::table('inputs')->insert([
                                        'id'    => '7783d108-c031-4f97-8d81-edeb753d6d97',
                                        'title' => 'دو گزینه ای',
                                        'name'  => 'BOOL',
                                    ]);
        
        DB::table('inputs')->insert([
                                        'id'    => '229b0510-a440-43c0-8dfc-6f304f754c27',
                                        'title' => 'انتخاب چندگانه',
                                        'name'  => 'MULTI_SELECT',
                                    ]);
        
        DB::table('inputs')->insert([
                                        'id'    => '0cc68be4-431d-4590-bbf3-ebf4120e4a20',
                                        'title' => 'چند گزینه ای',
                                        'name'  => 'SELECTABLE',
                                    ]);
        
        DB::table('inputs')->insert([
                                        'id'    => 'fe406fe3-5940-4e2f-a8f8-2a96089d8dba',
                                        'title' => 'انتخاب فایل',
                                        'name'  => 'FILE_DOC',
                                    ]);
        
        DB::table('inputs')->insert([
                                        'id'    => '98fdb80a-fd9f-4609-af5a-8c8ff3a06502',
                                        'title' => 'انتخاب تصویر',
                                        'name'  => 'FILE_PIC',
                                    ]);
        
        DB::table('inputs')->insert([
                                        'id'    => 'b4e7bd68-fcc0-4ae4-9aff-7170c60db177',
                                        'title' => 'وزن',
                                        'name'  => 'WEIGHT',
                                    ]);
        
        DB::table('inputs')->insert([
                                        'id'    => '8ed90808-ed93-406e-9e65-5d1334fde431',
                                        'title' => 'ابعاد',
                                        'name'  => 'DIMENSION',
                                    ]);
    }
}
