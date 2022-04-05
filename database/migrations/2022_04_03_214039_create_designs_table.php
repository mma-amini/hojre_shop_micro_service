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
        Schema::create('designs', function (Blueprint $table) {
            $table->foreignUuid('id')->primary();
            $table->uuid('shop_id');
            $table->uuid('product_id');
            $table->uuid('warranty_id')->nullable();
            $table->string('design_name');
            $table->string('barcode')->nullable();
            $table->double('price')->default(0);
            $table->double('off_price')->default(0);
            $table->integer('quantity', false, true)->default(0);
            $table->boolean('is_available')->default(true);
            $table->boolean('is_ready')->nullable();
            $table->tinyInteger('ready_day', false, true)->default(0);
            $table->tinyInteger('ready_hour', false, true)->default(0);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('shop_id')->references('id')->on('shops')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('warranty_id')->references('id')->on('warranties')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('designs');
    }
};
