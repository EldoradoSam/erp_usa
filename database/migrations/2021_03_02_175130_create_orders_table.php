<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pp_orders', function (Blueprint $table) {
            $table->id('order_id',25)->unique();
            $table->string('customer_name',200);
            $table->string('purchase_order',200); 
            //$table->string('product_name',200); 
            $table->string('bill_address',200);
            $table->string('delivery_address',200);
            $table->string('cosignee_details',200);
            $table->string('party_details',200);            
            $table->date('delivery_date');
            $table->string('quantity_pieces',200);
            $table->string('product_code',200);
            $table->string('product_dimensions',200);
            $table->foreignId('shipping_term_id');
            $table->foreignId('product_mix_id');
            $table->foreignId('washed_level_id');
            $table->boolean('naked_plank');
            $table->boolean('slap_upside_down');
            $table->boolean('drain_holes');
            $table->boolean('dripper_holes');
            $table->foreignId('plant_hole_size_id');
            $table->boolean('if_10_15_standing');
            $table->boolean('if_10_15_lying');
            $table->string('name_fill',200);
            $table->date('date');
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
        Schema::dropIfExists('orders');
    }
}
