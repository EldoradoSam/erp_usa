<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('st_suppliers', function (Blueprint $table) {
            $table->string('supplier_id',)->unique();
            $table->string('supplier_name', 100);
            $table->string('address');
            $table->string('web_address')->nullable();
            $table->string('country_id')->nullable();
            $table->string('district_id')->nullable();
            $table->string('town_id')->nullable();
            $table->string('gmap', 250)->nullable();
            $table->string('supplier_type_id')->nullable();
            $table->string('account_group_id')->nullable();
            $table->string('tax1_no')->nullable();
            $table->string('tax2_no')->nullable();
            $table->string('alert_credit_limit')->nullable();
            $table->string('alert_credit_period')->nullable();
            $table->string('hold_credit_limit')->nullable();
            $table->string('hold_credit_period')->nullable();
            $table->string('status_id')->nullable();
            $table->string('notes')->nullable();
            $table->string('bank_id')->nullable();
            $table->string('bank_branch_id')->nullable();
            
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
        Schema::dropIfExists('suppliers');
    }
}
