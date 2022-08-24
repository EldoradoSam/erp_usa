<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('st_customer_contacts', function (Blueprint $table) {
            $table->id('contact_id');
            $table->string('customer_id',25);
            $table->string('designation',150);
            $table->string('email',250);
            $table->string('mobile',20);
            $table->string('fixed',20);
            $table->boolean('sms_alert');
            $table->boolean('email_alert');
            $table->boolean('primary');


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
        Schema::dropIfExists('customer_contacts');
    }
}
