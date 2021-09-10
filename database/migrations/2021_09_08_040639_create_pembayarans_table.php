<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_rawat')->unsigned()->nullable(true);
            $table->foreign('id_rawat')->references('id')->on('rawat_inaps');
            $table->integer('biaya_kamar');
            $table->integer('jumlah_hari');
            $table->integer('total_biaya_kamar');
            $table->integer('biaya_perawatan');
            $table->bigInteger('total_biaya');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('pembayarans');
    }
}
