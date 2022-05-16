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
        Schema::create('spec_item_spec_value', function (Blueprint $table) {
            $table->uuid('spec_item_id');
            $table->uuid('spec_value_id');
            
            $table->foreign('spec_item_id')->references('id')->on('spec_items')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('spec_value_id')->references('id')->on('spec_values')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('spec_item_spec_value');
    }
};
