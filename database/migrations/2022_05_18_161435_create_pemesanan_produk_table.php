<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan_produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('ongkir_id');
            $table->integer('harga');
            $table->integer('jumlah_transaksi');
            $table->integer('total_pembayaran');
            $table->string('metode_pembayaran');
            $table->date('tanggal_pengantaran');
            $table->text('catatan')->nullable();
            $table->enum('status',['Belum Dikirim','Dikirim','Diterima'])->nullable();
            $table->timestamps();

            $table->foreign('produk_id')->references('id')->on('produk');
            $table->foreign('customer_id')->references('id')->on('customer');
            $table->foreign('ongkir_id')->references('id')->on('ongkir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemesanan_produk');
    }
}
