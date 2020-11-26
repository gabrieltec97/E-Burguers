<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('fullName');
            $table->string('city');
            $table->string('address');
            $table->string('temporaryAddress');
            $table->string('homeNumber');
            $table->string('referencePoint');
            $table->string('neighborhood');
            $table->string('phone')->nullable();
            $table->string('secondaryPhone')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
