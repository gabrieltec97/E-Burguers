<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trays', function (Blueprint $table) {
            $table->id();
            $table->string('idClient');
            $table->string('orderType');
            $table->longText('detached')->nullable();
            $table->string('hamburguer')->nullable();
            $table->string('portion')->nullable();
            $table->string('drinks')->nullable();
            $table->longText('comboItem')->nullable();
            $table->longText('clientComments')->nullable();
            $table->string('image')->nullable();
            $table->string('deliverWay')->nullable();
            $table->string('totalValue')->nullable();
            $table->string('day')->nullable();
            $table->string('hour')->nullable();
            $table->string('address')->nullable();
            $table->string('payingMethod')->nullable();
            $table->string('payingValue')->nullable();
            $table->string('disccountUsed')->nullable();
            $table->longText('extras')->nullable();
            $table->string('valueWithoutDisccount')->nullable();
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
        Schema::dropIfExists('trays');
    }
}
