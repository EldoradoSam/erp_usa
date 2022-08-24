<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePpDailyCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pp_daily_collection', function (Blueprint $table) {
            $table->id('dailyCollection_id',25)->unique();
            $table->date('date');
            $table->string('plan',200);
            $table->string('balance',200);
            $table->string('required',200);
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
        Schema::dropIfExists('pp_daily_collection');
    }
}
