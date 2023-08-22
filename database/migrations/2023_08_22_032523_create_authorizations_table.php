<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authorizations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('module_id');
            $table->unsignedInteger('authorization_type_id');
            $table->unsignedInteger('role_id');
            $table->tinyInteger('type');
            $table->timestamps();

            $table->foreign('module_id')->references('id')->on('modules');
            $table->foreign('authorization_type_id')->references('id')->on('authorization_types');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authorizations');
    }
}
