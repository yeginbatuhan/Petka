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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
          $table->unsignedBigInteger('order_id')->index();
          $table->foreign('order_id')
            ->on('orders')
            ->references('id')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->string('order_detail_name');
            $table->string('order_detail_code');
            $table->string('order_detail_unit');
            $table->string('order_detail_order');
            $table->string('order_detail_delivery');
            $table->string('order_detail_remaining');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
