<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keuangan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesanan_produk_id')->nullable();
            $table->enum('keterangan',['masuk','keluar']);
            $table->string('transaksi');
            $table->integer('jumlah_transaksi');
            $table->integer('harga_satuan');
            $table->integer('total_transaksi');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();

            $table->foreign('pemesanan_produk_id')->references('id')->on('pemesanan_produk');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keuangan');
    }
}
