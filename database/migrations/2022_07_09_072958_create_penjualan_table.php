<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('penjualan');

        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_barang')->length(11);
            $table->integer('qty')->length(11);
            $table->date('tgl_jual');
            $table->integer('status')->length(11);
            $table->date('tgl_lunas')->nullable();
            $table->text('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan');
    }
}
