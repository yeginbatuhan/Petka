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
    Schema::create('ongoings', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id')->index();
      $table->foreign('user_id')
        ->on('users')
        ->references('id')
        ->onDelete('cascade')
        ->onUpdate('cascade');
      $table->string('ongoing_order_code')->nullable();
      $table->string('ongoing_order_description')->nullable();
      $table->date('ongoing_order_date')->nullable();
      $table->date('ongoing_delivery_date')->nullable();
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
    Schema::dropIfExists('ongoings');
  }
};
