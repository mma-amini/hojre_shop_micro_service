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
            $table->uuid('product_id');
            $table->string('design_name');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->softDeletes();
    
            $table->foreign('products_id')->references('id')->on('products')->cascadeOnDelete()->cascadeOnUpdate();
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
