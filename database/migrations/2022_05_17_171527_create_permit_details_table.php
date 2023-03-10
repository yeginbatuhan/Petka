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
    Schema::create('permit_details', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('permit_id')->index();
      $table->foreign('permit_id')
        ->on('permits')
        ->references('id')
        ->onDelete('cascade')
        ->onUpdate('cascade');
      $table->date('permit_detail_start_date')->nullable();
      $table->date('permit_detail_end_date')->nullable();
      $table->string('permit_detail_use_day');
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
    Schema::dropIfExists('permit_details');
  }
};
