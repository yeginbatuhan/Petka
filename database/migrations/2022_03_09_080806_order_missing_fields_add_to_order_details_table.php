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
        Schema::table('order_details', function (Blueprint $table) {
            $table->text('order_detail_description');
            $table->string('order_detail_unit_price');
            $table->string('order_detail_vat');
            $table->string('order_detail_discount');
            $table->string('order_detail_total');
            $table->string('order_detail_stock');
            $table->date('order_detail_order_date')->nullable();
            $table->date('order_detail_delivery_date')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            //
        });
    }
};
