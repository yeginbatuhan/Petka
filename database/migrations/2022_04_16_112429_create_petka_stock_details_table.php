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
        Schema::create('petka_stock_details', function (Blueprint $table) {
            $table->id();
          $table->unsignedBigInteger('petka_stock_id')->index();
          $table->foreign('petka_stock_id')
            ->on('petka_stocks')
            ->references('id')
            ->onDelete('cascade')
            ->onUpdate('cascade');
          $table->string('petka_stock_detail_code')->nullable();
          $table->string('petka_stock_detail_name_tr')->nullable();
          $table->string('petka_stock_detail_name_en')->nullable();
          $table->string('petka_stock_detail_quantity')->nullable();
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
        Schema::dropIfExists('petka_stock_details');
    }
};
