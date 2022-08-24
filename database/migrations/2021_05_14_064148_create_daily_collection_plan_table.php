<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyCollectionPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pp_daily_collection_plan', function (Blueprint $table) {
            $table->id('pp_daily_collection_plan_id',25)->unique();     
            $table->date('date');
            $table->double('required');
            $table->double('balance'); 

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
        Schema::dropIfExists('daily_collection_plan');
    }
}
