<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachineryPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pp_machinery_plans', function (Blueprint $table) {
            $table->id('machinery_plans_id');
            $table->integer('customer_order_plan_data_id');
            $table->string('machine_id',150);
            $table->string('product_id',150);
            $table->date('date');
            $table->integer('day_quantity');
            $table->integer('night_quantity');
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
        Schema::dropIfExists('machinery_plans');
    }
}
