<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id('Nim');
            $table->string("Nama")->nullable(false);
            $table->string("Kelas")->nullable(false);
            $table->string("Jurusan")->nullable(false);
            $table->string("No_Hp")->nullable(false);
            $table->string("Email")->nullable(false);
            $table->String('Gambar', 255)->nullable();
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
        Schema::dropIfExists('anggotas');
    }
}
