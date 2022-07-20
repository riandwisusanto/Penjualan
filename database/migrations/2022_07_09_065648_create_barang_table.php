<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('barang');
        
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('gambar', 255)->nullable();
            $table->integer('no_sku')->length(11)->nullable();
            $table->date('tanggal');
            $table->string('nama_brg', 255);
            $table->string('merk', 255)->nullable();
            $table->string('kode_brg', 255)->nullable();
            $table->string('warna', 255)->nullable();
            $table->integer('qty_brg')->length(11);
            $table->text('keterangan')->nullable();
            $table->integer('harga_beli')->length(11);
            $table->integer('harga_jual')->length(11);
            // $table->integer('diskon')->length(11)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
