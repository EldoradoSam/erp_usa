<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupLevel2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('st_group_level_2', function (Blueprint $table) {
            $table->id('group_level_2_id');
            $table->foreignId('grp_lvl_1_for_id')->reference('group_level_1_id')->on('sc_group_level_1');
            $table->string('group_level_2');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('group_level2s');
    }
}
