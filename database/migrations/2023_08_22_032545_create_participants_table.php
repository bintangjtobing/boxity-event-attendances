<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->string('participant_id', 45)->primary();
            $table->unsignedInteger('event_id');
            $table->string('name', 150)->unique();
            $table->string('jabatan');
            $table->string('no_hp',45)->nullable();
            $table->string('instansi');
            $table->text('alamat_instansi');
            $table->date('tanggal_kedatangan');
            $table->text('penginapan');
            $table->date('tanggal_kembali');
            $table->text('qr_code');
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
