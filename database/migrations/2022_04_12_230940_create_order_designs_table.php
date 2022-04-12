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
        Schema::create('order_designs', function (Blueprint $table) {
            $table->foreignUuid('id')->primary();
            $table->uuid('order_id');
            $table->uuid('design_id');
            $table->uuid('shop_id');
            $table->unsignedBigInteger('order_condition_id');
            $table->smallInteger('count')->default(0);
            $table->timestamps();
            
            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('design_id')->references('id')->on('designs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('shop_id')->references('id')->on('shops')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('order_condition_id')->references('id')->on('order_conditions')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('order_designs');
    }
};
