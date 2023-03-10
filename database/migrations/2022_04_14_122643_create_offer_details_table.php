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
    Schema::create('offer_details', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('offer_id')->index();
      $table->foreign('offer_id')
        ->on('offers')
        ->references('id')
        ->onDelete('cascade')
        ->onUpdate('cascade');
      $table->string('offer_detail_code')->nullable();
      $table->string('offer_detail_name_tr')->nullable();
      $table->string('offer_detail_name_en')->nullable();
      $table->string('offer_detail_quantity')->nullable();
      $table->string('offer_detail_unit_price')->nullable();
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
    Schema::dropIfExists('offer_details');
  }
};
