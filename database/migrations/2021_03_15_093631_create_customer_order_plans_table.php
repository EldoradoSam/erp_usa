<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerOrderPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pp_customer_order_plans', function (Blueprint $table) {
            $table->id('customer_order_plan_id',25)->unique();
            $table->foreignId('order_id',25);
            //$table->string('order_data_id',200);
            $table->string('manufacturing_order_number',200);
            $table->date('trans_date');
            $table->date('from_date');
            $table->date('to_date');
            $table->string('description',300)->nullable();
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
        Schema::dropIfExists('customer_order_plans');
    }
}
