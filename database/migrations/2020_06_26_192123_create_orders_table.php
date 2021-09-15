<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('idClient');
            $table->longText('clientName');
            $table->string('status');
            $table->string('orderType');
            $table->longText('detached')->nullable();
            $table->string('comboItem')->nullable();
            $table->string('hamburguer')->nullable();
            $table->string('fries')->nullable();
            $table->string('drinks')->nullable();
            $table->longText('comments')->nullable();
            $table->longText('clientComments')->nullable();
            $table->string('deliverWay')->nullable();
            $table->longText('totalValue')->nullable();
            $table->string('day')->nullable();
            $table->string('monthDay')->nullable();
            $table->string('year')->nullable();
            $table->string('hour')->nullable();
            $table->string('month')->nullable();
            $table->string('address')->nullable();
            $table->string('payingMethod')->nullable();
            $table->string('payingValue')->nullable();
            $table->string('usedCoupon')->nullable();
            $table->longText('extras')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
