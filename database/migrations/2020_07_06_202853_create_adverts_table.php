<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value');
            $table->string('foodType');
            $table->string('status');
            $table->string('ingredients')->nullable();
            $table->string('extras')->nullable();
            $table->string('combo');
            $table->string('tastes')->nullable();
            $table->string('description');
            $table->string('comboValue')->nullable();
            $table->string('picture')->nullable();
            $table->string('ratingGrade')->nullable();
            $table->string('ratingAmount')->nullable();
            $table->string('finalGrade')->nullable();
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
        Schema::dropIfExists('adverts');
    }
}
