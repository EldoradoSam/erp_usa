<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePpMachineryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pp_machinery', function (Blueprint $table) {

            $table->id('machinery_id',25)->unique();
            $table->string('machinery_no', 25)->nullable();
            $table->string('machinery_name', 25)->nullable();
            $table->string('site_id');
            $table->string('description')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('pp_machinery');
    }
}
