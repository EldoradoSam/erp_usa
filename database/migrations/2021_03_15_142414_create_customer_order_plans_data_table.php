<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerOrderPlansDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pp_customer_order_plans_data', function (Blueprint $table) {
            $table->id('customer_order_plan_data_id',25)->unique();
            $table->foreignId('customer_order_plan_id',25);  
            $table->foreignId('order_data_id',25); 
            $table->string('manufacturing_order_no',100);       
            $table->date('start_date');
            $table->date('end_date');
            $table->string('product_id', 25);
            $table->string('product_name', 25);
            $table->string('quantity',300); 
            $table->boolean('status');     
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
        Schema::dropIfExists('customer_order_plans_data');
    }
}
