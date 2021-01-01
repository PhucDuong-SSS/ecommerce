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
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->string('payment_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('paying_amount')->nullable();
            $table->string('blnc_transection')->nullable();
            $table->string('stripe_order_id')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('vat')->nullable();
            $table->string('shipping')->nullable();
            $table->float('total',15,2)->nullable();
            $table->string('status')->nullable()->default(0);
            $table->string('status_code')->nullable();
            $table->string('month')->nullable();
            $table->string('date')->nullable();
            $table->string('year')->nullable();
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
