<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuxiliarDetachedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auxiliar_detacheds', function (Blueprint $table) {
            $table->id();
            $table->string('idOrder')->nullable();
            $table->string('foodType')->nullable();
            $table->string('Item')->nullable();
            $table->longText('Extras')->nullable();
            $table->longText('nameExtra')->nullable();
            $table->string('valueWithExtras')->nullable();
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
        Schema::dropIfExists('auxiliar_detacheds');
    }
}
