<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pp_customer_orders', function (Blueprint $table) {
            $table->id('order_id',25)->unique();
            $table->string('customer_id',200);
            $table->string('customer_name',200);
            $table->string('purchase_order',200);
            $table->string('factory_po_num',200);
            $table->string('invoice_num',200);
            $table->string('bill_address',500);
            $table->string('delivery_address',500);
            $table->integer('delivery_address_id');
            $table->string('cosignee_details',500);
            $table->string('party_details',500);
            $table->date('date');
            $table->foreignId('country_id');
            $table->date('delivery_date');
            $table->foreignId('shipping_term_id');
            $table->string('name_fill',200);
            $table->string('remarks')->nullable();
            $table->boolean('production_status')->nullable();
            $table->boolean('status');
            $table->integer('order_status');
            $table->integer('fund_status');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->string('create_from',45);
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
        Schema::dropIfExists('customer_orders');
    }
}
