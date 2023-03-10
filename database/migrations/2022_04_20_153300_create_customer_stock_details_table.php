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
  public function up()
  {
    Schema::create('customer_stock_details', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('customer_stock_id')->index();
      $table->foreign('customer_stock_id')
        ->on('customer_stocks')
        ->references('id')
        ->onDelete('cascade')
        ->onUpdate('cascade');
      $table->string('customer_stock_detail_name_tr')->nullable();
      $table->string('customer_stock_detail_name_en')->nullable();
      $table->string('customer_stock_detail_quantity')->nullable();
      $table->string('customer_stock_detail_unit')->nullable();
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
    Schema::dropIfExists('customer_stock_details');
  }
};
