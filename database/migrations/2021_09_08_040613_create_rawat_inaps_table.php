<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawatInapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rawat_inaps', function (Blueprint $table) {
            $table->id();
            $table->string('no_reg');
            $table->bigInteger('id_pasien')->unsigned()->nullable(true);
            $table->foreign('id_pasien')->references('id')->on('pasiens');
            $table->bigInteger('id_kamar')->unsigned()->nullable(true);
            $table->foreign('id_kamar')->references('id')->on('kamars');
            $table->dateTime('tanggal_masuk');
            $table->dateTime('tanggal_keluar')->nullable(true)->default(null);
            $table->string('penanggung_jawab');
            $table->string('hubungan_penanggung_jawab');
            $table->text('diagnosa_awal');
            $table->string('penerimaan');
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
        Schema::dropIfExists('rawat_inaps');
    }
}
