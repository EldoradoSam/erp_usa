<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePpBomDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pp_bom_data', function (Blueprint $table) {
            $table->id('pp_bom_plan_data_id',25)->unique();
            $table->foreignId('pp_bom_header_id',25);        
            $table->string('product_id', 25);
            $table->string('product_name', 250);
            $table->double('quantity');
            $table->string('uom', 10);
            $table->double('tolerance');
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
        Schema::dropIfExists('pp_bom_data');
    }
}
