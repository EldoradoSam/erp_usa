<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePpMachineryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pp_machinery_product', function (Blueprint $table) {
            $table->id('machinery_product_id',25)->unique();
            $table->string('machinery_id', 25);
            $table->string('product_Id', 25);
            $table->string('quantity');
            $table->string('umo')->nullable();
            $table->string('wastage')->nullable();
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
        Schema::dropIfExists('pp_machinery_product');
    }
}
