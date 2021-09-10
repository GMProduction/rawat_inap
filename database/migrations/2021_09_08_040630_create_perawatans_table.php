<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerawatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perawatans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_rawat')->unsigned()->nullable(true);
            $table->foreign('id_rawat')->references('id')->on('rawat_inaps');
            $table->bigInteger('id_dokter')->unsigned()->nullable(true);
            $table->foreign('id_dokter')->references('id')->on('dokters');
            $table->bigInteger('id_perawat')->unsigned()->nullable(true);
            $table->foreign('id_perawat')->references('id')->on('perawats');
            $table->bigInteger('id_obat')->unsigned()->nullable(true);
            $table->foreign('id_obat')->references('id')->on('obats');
            $table->bigInteger('id_tindakan')->unsigned()->nullable(true);
            $table->foreign('id_tindakan')->references('id')->on('obats');
            $table->dateTime('tanggal');
            $table->string('tensi_darah');
            $table->integer('suhu_badan');
            $table->integer('biaya');
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
        Schema::dropIfExists('perawatans');
    }
}
