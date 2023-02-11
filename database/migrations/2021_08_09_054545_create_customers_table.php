<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('st_customers', function (Blueprint $table) {
            $table->id('customer_id');
            $table->string('customer_name',100);
            $table->string('address',500);
            $table->string('delivery_address',500);
            $table->string('cosignee_details',500);
            $table->string('party_details',500)->nullable();
            $table->string('web');
            $table->integer('country_id');
            $table->integer('accountgroup_id');
            $table->string('status_id');
            $table->string('notes');
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
        Schema::dropIfExists('customers');
    }
}
