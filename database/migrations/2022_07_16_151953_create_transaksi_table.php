<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('transaksi');
        
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pembeli');
            $table->dateTime('tgl_transaksi')->nullable();
            $table->dateTime('tgl_lunas')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('transaksi');
    }
}
