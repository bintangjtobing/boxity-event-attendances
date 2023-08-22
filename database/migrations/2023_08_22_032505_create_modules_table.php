<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('module_group_id')->nullable();
            $table->string('name', 45);
            $table->string('order', 45)->nullable();
            $table->string('icon', 45)->nullable();
            $table->string('route', 45);
            $table->tinyInteger('is_shown');
            $table->tinyInteger('type');
            $table->timestamps();

            $table->foreign('module_group_id')->references('id')->on('module_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
