<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('st_supplier_contacts', function (Blueprint $table) {
            $table->id('contact_id');
            $table->string('supplier_foriegn_id')->foreignID('supplier_foriegn_id', )->reference('supplier_id')->on('suppliers');
            $table->string('designation', 150)->nullable();
            $table->string('email', 250)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('fixed', 20)->nullable();
            $table->boolean('sms_alert')->nullable();
            $table->boolean('email_alert')->nullable();
            $table->boolean('primary_contact')->nullable();
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
        Schema::dropIfExists('supplier_contacts');
    }
}
