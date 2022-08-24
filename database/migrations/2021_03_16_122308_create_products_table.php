<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('st_products', function (Blueprint $table) {
            $table->id('product_primary_id');
            $table->string('product_id', 25);
            $table->string('product_name', 150);
            $table->string('product_description', 250)->nullable();
            $table->string('uom_id');
            $table->string('sku', 50)->nullable();
            $table->string('group_id_level_1');
            $table->string('group_id_level_2');
            $table->string('group_id_level_3');
            $table->string('reorder_level')->nullable();
            $table->string('reorder_quantity')->nullable();
            $table->string('product_type_id');
            $table->string('gl_analysis_id');
            $table->boolean('sms_alert');
            $table->boolean('email_alert');
            $table->boolean('notification');
            $table->boolean('status');
            $table->string('image_path', 250)->nullable();
            $table->string('notes');
            $table->string('weight');

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
        Schema::dropIfExists('products');
    }
}
