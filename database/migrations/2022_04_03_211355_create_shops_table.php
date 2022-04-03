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
        Schema::create('shops', function (Blueprint $table) {
            $table->foreignUuid('id')->primary();
            $table->uuid('user_id');
            $table->string('shop_name');
            $table->string('shop_state')->nullable();
            $table->string('shop_address')->nullable();
            $table->string('shop_postal_code')->nullable();
            $table->string('shop_phone')->nullable();
            $table->geometry('shop_location')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->softDeletes();
    
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('shops');
    }
};
