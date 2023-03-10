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
    Schema::create('customer_stocks', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id')->index();
      $table->foreign('user_id')
        ->on('users')
        ->references('id')
        ->onDelete('cascade')
        ->onUpdate('cascade');
      $table->string('customer_stock_code')->nullable();
      $table->string('customer_stock_name_tr')->nullable();
      $table->string('customer_stock_name_en')->nullable();
      $table->tinyInteger('is_active')->default(1);
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
    Schema::dropIfExists('customer_stocks');
  }
};
