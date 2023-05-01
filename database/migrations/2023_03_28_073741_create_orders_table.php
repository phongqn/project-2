<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->unsignedBigInteger('customer_id');
            $table->bigInteger('total_price');
            $table->bigInteger('quantity');
            $table->bigInteger('phone');
            $table->string('email');
            $table->string('address');
            $table->bigInteger('type')->default(1);
            $table->bigInteger('payment_method');
            $table->bigInteger('price_ship')->default(0);
            $table->bigInteger('status')->default(0);
            $table->string('country');
            $table->string('note');
            $table->unsignedBigInteger('discount_id');
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
};
