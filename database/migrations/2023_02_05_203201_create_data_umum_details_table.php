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
        Schema::create('data_umum_details', function (Blueprint $table) {
            $table->id();
            $table->string('data_umum_id');
            $table->date('tgl_adendum')->nullable();
            $table->string('nilai_kontrak');
            $table->string('panjang_km');
            $table->integer('lama_waktu');
            $table->integer('kontraktor_id');
            $table->integer('konsultan_id');
            $table->integer('ppk_id');
            $table->boolean('is_active')->default(true);
            $table->string('keterangan');
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
        Schema::dropIfExists('data_umum_details');
    }
};
