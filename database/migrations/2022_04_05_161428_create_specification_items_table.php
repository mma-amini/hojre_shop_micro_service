<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specification_items', function (Blueprint $table) {
            $table->foreignUuid('id')->primary();
            $table->uuid('specification_id');
            $table->uuid('input_id');
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('specification_id')->references('id')->on('specifications')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('input_id')->references('id')->on('inputs')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specification_items');
    }
};
