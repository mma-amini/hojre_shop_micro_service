<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('orders', function (Blueprint $table) {
            $table->foreignUuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('address_id');
            $table->unsignedBigInteger('order_condition_id');
            $table->string('tracking_code');
            $table->integer('total_amount')->default(0);
            $table->integer('amount_pay')->default(0);
            $table->integer('delivery_amount')->default(0);
            $table->date('delivery_choose_date');
            $table->time('delivery_choose_time');
            $table->dateTime('delivery_date_time');
            $table->tinyInteger('sending_type')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('address_id')->references('id')->on('user_addresses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('order_condition_id')->references('id')->on('order_conditions')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('orders');
    }
};
