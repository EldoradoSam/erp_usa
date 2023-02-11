<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerOrdersDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pp_customer_orders_data', function (Blueprint $table) {
            $table->id('order_data_id',25)->unique();
            $table->foreignId('order_id',25);
            $table->string('product_type',200);
            $table->string('product_code',200);
            $table->string('product_dimensions',200);
            $table->foreignId('product_mix_id');
            $table->foreignId('washed_level_id');
            $table->boolean('naked_plank');
            $table->string('slab_position',100);
            $table->boolean('dripper_holes');
            $table->integer('no_of_dripper');
            $table->boolean('drain_holes');
            $table->integer('no_of_drain');
            $table->string('drain_holes_size',50);
            $table->string('drain_holes_shape',200);
            $table->boolean('dug_holes');
            $table->integer('no_of_dug');
            $table->string('dug_holes_size',50);
            $table->boolean('vegetableCheck')->nullable();
            $table->boolean('berryCheck')->nullable();
            $table->boolean('flowersCheck')->nullable();
            $table->boolean('PCMCheck')->nullable();
            $table->boolean('OthersCheck')->nullable();
            $table->boolean('plant_holes');
            $table->integer('no_of_plant');
            $table->string('plant_holes_size',50);
            $table->string('standing_Lying',100);
            $table->boolean('Bio_Degratable_Bags');
            $table->string('pallet',100);
            $table->boolean('Bottom_Mesh_Liner');
            $table->boolean('Boxes_Cases');
            $table->string('pcs_per_boxes',50);
            $table->string('boxes_pallet',50);
            $table->string('boxes_master_cartoon',50);
            $table->string('master_cartoon_pallets',50);
            $table->string('quantity_pieces',200);
            $table->string('description',500);
            $table->integer('token');
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
        Schema::dropIfExists('customer_orders_data');
    }
}
