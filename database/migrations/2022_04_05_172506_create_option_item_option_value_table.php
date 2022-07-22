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
        Schema::create('option_item_option_value', function (Blueprint $table) {
            $table->uuid('option_item_id');
            $table->uuid('option_value_id');

            $table->foreign('option_item_id')->references('id')->on('option_items')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('option_value_id')->references('id')->on('option_values')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('option_item_option_value');
    }
};
