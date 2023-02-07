<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_umums', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('pemda');
            $table->string('opd');
            $table->string('nm_paket');
            $table->string('no_kontrak');
            $table->date('tgl_kontrak');
            $table->string('no_spmk');
            $table->date('tgl_spmk');
            $table->integer('kategori_paket_id');
            $table->string('uptd_id');
            $table->string('ppk_kegiatan');
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
        Schema::dropIfExists('data_umums');
    }
};
