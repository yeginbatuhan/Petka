<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_news', function (Blueprint $table) {
          $table->id();
          $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
          $table->string('person_new_title');
          $table->string('person_new_image');
          $table->string('person_new_text');
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
        Schema::dropIfExists('person_news');
    }
};
