<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSekolahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('jenjang_id');
            $table->unsignedBigInteger('kecamatan_id');
            $table->string('status');
            $table->string('alamat');
            $table->string('posisi');
            $table->text('deskripsi');
            $table->string('foto');
            $table->foreign('jenjang_id')->references('id')->on('jenjangs');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans');
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
        Schema::dropIfExists('sekolahs');
    }
}
