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
        Schema::create('spec_value_spec_item', function (Blueprint $table) {
            $table->uuid('specification_item_id');
            $table->uuid('specification_value_id');
            
            $table->foreign('specification_item_id')->references('id')->on('specification_items')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('specification_value_id')->references('id')->on('specification_values')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('spec_value_spec_item');
    }
};
