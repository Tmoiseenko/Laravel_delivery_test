<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->text('full_name');
            $table->string('phone');
            $table->unsignedBigInteger('diet_id');
            $table->timestamp('delivery_start');
            $table->timestamp('delivery_end');
            $table->unsignedBigInteger('delivery_variation_id');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('diet_id')->references('id')->on('diets')->onDelete('cascade');
            $table->foreign('delivery_variation_id')->references('id')->on('delivery_variations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
