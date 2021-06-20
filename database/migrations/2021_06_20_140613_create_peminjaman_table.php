<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anggota_id')->nullable();
            $table->unsignedBigInteger('buku_id')->nullable();
            $table->foreign('anggota_id')->references('Nim')->on('anggotas');
            $table->foreign('buku_id')->references('id_buku')->on('bukus');
            $table->integer('jumlah');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali')->nullable();
            $table->integer('lama_pinjam')->nullable();
            $table->string('status', 30);
            $table->tinyInteger('perpanjang')->nullable();
            $table->integer('denda')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
