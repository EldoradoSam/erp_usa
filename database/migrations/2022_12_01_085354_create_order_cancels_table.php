<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderCancelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pp_order_cancels', function (Blueprint $table) {
            $table->id('order_cancel_id');
            $table->date('date');
            $table->string('factory_po_no',25);
            $table->string('customer_po_no',25);
            $table->integer('order_id');
            $table->integer('reason_id');
            $table->string('remarks',100)->nullable();
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
        Schema::dropIfExists('order_cancels');
    }
}
