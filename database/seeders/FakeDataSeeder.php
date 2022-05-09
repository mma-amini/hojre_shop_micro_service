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
           'gender' => 1,
           'email' => 'm.m.aminn11@gmail.com',
           'birthday' => '1983/12/25',
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
           'shop_name'        => 'نگین اروند',
           'shop_state'       => 'dsfsdf',
           'shop_address'     => 'dsfhghjghjjhsdf',
           'shop_postal_code' => '213548794564',
           'shop_phone'       => '02122444798',
       ]);

       DB::table('users')->insert([
           'id'         => "30c5e4ef-fd96-45ab-80d4-d6576fb26ea9",
           'first_name' => 'مینا',
           'last_name'  => 'قهرمان شهرکی',
           'username'   => '09366707862',
           'password'   => Hash::make("123456"),
           'gender' => 2,
           'email' => 'mina.ghahraman@gmail.com',
           'birthday' => '1984/07/15',
       ]);

       DB::table('role_user')->insert([
           'user_id' => '30c5e4ef-fd96-45ab-80d4-d6576fb26ea9',
           'role_id' => 'b6b7a78d-70f3-467a-afb8-18c0661cb0c9',
       ]);

       DB::table('users')->insert([
           'id'         => "818635eb-76f6-4a86-85c1-a78a8a316c55",
           'first_name' => 'علی',
           'last_name'  => 'بخشی',
           'username'   => '09366701122',
           'password'   => Hash::make("123456"),
           'gender' => 1,
           'email' => 'ali.bakhshi@gmail.com',
           'birthday' => '1979/11/03',
       ]);

        DB::table('categories')->insert([
            'id'         => "7d6613e6-8832-477b-bc9f-fe08d239e73d",
            'category_name' => 'خانه و آشپزخانه',
            'picture'  => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzhB2g__WSjMp8em8G0DPOmivsk36ZVmifnA&usqp=CAU',
            'parent_id'   => null,
        ]);

        DB::table('categories')->insert([
            'id'         => "cee39cc7-5cea-4360-a2b8-90c285d6de0d",
            'category_name' => 'تهویه - سرمایش - گرمایش',
            'picture'  => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzhB2g__WSjMp8em8G0DPOmivsk36ZVmifnA&usqp=CAU',
            'parent_id'   => '7d6613e6-8832-477b-bc9f-fe08d239e73d',
        ]);

        DB::table('categories')->insert([
            'id'         => "43dd1b0c-b2f4-4318-9829-f65423155bb2",
            'category_name' => 'لوازم خانگی برقی',
            'picture'  => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzhB2g__WSjMp8em8G0DPOmivsk36ZVmifnA&usqp=CAU',
            'parent_id'   => '7d6613e6-8832-477b-bc9f-fe08d239e73d',
        ]);

        DB::table('categories')->insert([
            'id'         => "26cb4963-5728-4205-9fe6-4a56ca40d5a0",
            'category_name' => 'قهوه و قهوه ساز',
            'picture'  => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzhB2g__WSjMp8em8G0DPOmivsk36ZVmifnA&usqp=CAU',
            'parent_id'   => '7d6613e6-8832-477b-bc9f-fe08d239e73d',
        ]);

        DB::table('categories')->insert([
            'id'         => "fda46400-9885-4bbf-9bc7-d86617b2eb24",
            'category_name' => 'کالای دیجیتال',
            'picture'  => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzhB2g__WSjMp8em8G0DPOmivsk36ZVmifnA&usqp=CAU',
            'parent_id'   => null,
        ]);

        DB::table('categories')->insert([
            'id'         => "8c5ff9de-5592-4207-8060-a5b7a525f53b",
            'category_name' => 'موبایل',
            'picture'  => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzhB2g__WSjMp8em8G0DPOmivsk36ZVmifnA&usqp=CAU',
            'parent_id'   => "fda46400-9885-4bbf-9bc7-d86617b2eb24",
        ]);

        DB::table('categories')->insert([
            'id'         => "f2dfaf6a-c4f7-4c29-92e7-cf7294a14617",
            'category_name' => 'صوتی و تصویری',
            'picture'  => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzhB2g__WSjMp8em8G0DPOmivsk36ZVmifnA&usqp=CAU',
            'parent_id'   => "fda46400-9885-4bbf-9bc7-d86617b2eb24",
        ]);

        DB::table('brands')->insert([
            'id'         => "b8c28e5f-aa9f-4695-a988-225ab0265d94",
            'brand_name' => 'Samsung',
            'picture'  => 'https://pngset.com/images/samsung-logo-background-samsung-logo-black-amp-white-gray-world-of-warcraft-transparent-png-1554443.png',
        ]);

       DB::table('products')->insert([
           'id' =>'d4f1daea-ad2d-4f83-bd1a-1ad02bfb3705',
           'product_name' => 'گوشی سامسونگ Galaxy S22',
           'brand_id' => 'b8c28e5f-aa9f-4695-a988-225ab0265d94',
           'is_original' => true,
           'packaging_dimensions' => '25x15x10',
           'product_dimensions' => '23x12x0.4',
           'packing_weight' => 650,
           'product_weight' => 400,
           'description' => 'سامسونگ Galaxy S22 Ultra 5G با بهره بردن از مشخصات فنی مناسب و فوق قدرتمند به‌عنوان پرچمدار شرکت سامسونگ در تاریخ 9 فوریه سال 2022 معرفی شد. در همان نگاه اول طراحی کمی مشابه با پرچمداران سری نوت این شرکت را شاهد هستیم که البته زیبایی بصری بسیار جذابی را هم با خود به‌همراه داشته است. در نمای رو‌به‌رویی سامسونگ Galaxy S22 Ultra 5G به صفحه‌نمایش با ابعاد 6.8 اینچ و رزولوشن 1440×3088 پیکسل از نوع Dynamic AMOLED 2X مجهز شده است. صفحه‌نمایش که توانایی نمایش 500 پیکسل در هر اینچ و نرخ بروزرسانی 120 هرتز را دارد. بدون هیچ حرف و حدیثی در این بخش باید گفت که سامسونگ Galaxy S22 Ultra 5G به یکی از قدرتمند‌ترین صفحات‌نمایش در بین گوشی‌های هوشمند مجهز شده است. در بخش سنسور‌های دوربین هم سامسونگ چیزی برای این گوشی پرچمدار کم نگذاشته است. یک سنسور دوربین اصلی با رزولوشن 108 مگاپیکسل از نوع عریض و گشودگی دریچه دیافراگم f/1.8 در کنار سنسور 10 مگاپیکسل از نوع پریسکوپ با قابلیت زوم 10 برابری اپتیکال به‌همراه سنسور 10 مگاپیکسل از نوع تله فوتو با قابلیت زوم 3 برابری اپتیکال و سنسور 12 مگاپیکسل از نوع فوق عریض (ultrawide) با زاویه دید 120 درجه، سنسور‌های دوربین چهارگانه سامسونگ Galaxy S22 Ultra 5G را تشکیل می‌دهند. سنسور دوربین اصلی در کنار توانایی ضبط ویدیو با حداکثر کیفیت 8K و سرعت 24 فریم در ثانیه، به قابلیت جذاب و البته کاربردی لرزشگیر اپتیکال یا همان OIS هم مجهز شده است. برای دوربین سلفی هم از یک سنسور با رزولوشن 40 مگاپیکسل و گشودگی دریچه دیافراگم f/2.2 استفاده شده است. در بخش مشخصات سخت‌افزاری هم برای بازار‌های اروپایی و خاورمیانه، پردازنده اختصاصی اگزینوس 2200 شرکت سامسونگ این گوشی هوشمند قدرتمند را همراه می‌کند. پردازنده‌ای با معماری 4 نانومتری که به خوبی از پس تمام بازی‌های سنگین و به‌روز حال و حاضر دنیا بر‌می‌آید. باتری با میزان ظرفیت 5000 میلی‌آمپر‌ساعت و پشتیبانی از فناوری شارژ سریع 45 وات هم از دیگر مشخصات در نظر گرفته شده است. البته لازک به ذکر است که این گوشی بدون آداپتور شارژر روانه بازار شده است. البته باید بدانید که این بار، قلم هوشمند و بسیار کاربردی S Pen هم برای این گوشی هوشمند در نظر گرفته شده و نیازی نیست همانند نسل قبلی آن را به‌عنوان یک وسیله جانبی خریداری کنید.'
       ]);

       DB::table('product_images')->insert([
        'id' => 'f0c1770e-65c3-4817-a69a-87e6bcc69a03',
        'product_id' => 'd4f1daea-ad2d-4f83-bd1a-1ad02bfb3705',
        'picture' => 'https://helios-i.mashable.com/imagery/reviews/074lTlwrLLcH7SVYrBFC2mU/hero-image.fill.size_1200x1200.v1645211431.jpg',
        'is_main' => true,
    ]);

    DB::table('product_images')->insert([
        'id' => '8d92c964-2a4e-4af0-a4ae-1e09fbbfbf78',
        'product_id' => 'd4f1daea-ad2d-4f83-bd1a-1ad02bfb3705',
        'picture' => 'https://cdn.pocket-lint.com/r/s/1200x/assets/images/159963-phones-review-hands-on-samsung-galaxy-s22-review-image10-iup2be3rak.jpg',
        'is_main' => false,
    ]);

       DB::table('category_product')->insert([
           'category_id' => 'fda46400-9885-4bbf-9bc7-d86617b2eb24',
           'product_id' => 'd4f1daea-ad2d-4f83-bd1a-1ad02bfb3705',
       ]);

       DB::table('category_product')->insert([
           'category_id' => '8c5ff9de-5592-4207-8060-a5b7a525f53b',
           'product_id' => 'd4f1daea-ad2d-4f83-bd1a-1ad02bfb3705',
       ]);

        DB::table('product_shop')->insert([
            'product_id' => 'd4f1daea-ad2d-4f83-bd1a-1ad02bfb3705',
            'shop_id' => 'abc76d9c-1778-469b-9621-0316e713f59a',
        ]);
    }
}
