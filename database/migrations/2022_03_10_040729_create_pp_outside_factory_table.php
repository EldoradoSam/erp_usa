<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePpOutsideFactoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pp_outside_factory', function (Blueprint $table) {
            $table->id('outside_factory_id');
            $table->string('outside_factory_code',150);
            $table->string('outside_factory_name',150);
            $table->string('outside_factory_place',150);
            $table->string('outside_factory_description',500);
            $table->integer('supplier_id');
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
        Schema::dropIfExists('pp_outside_factory');
    }
}
