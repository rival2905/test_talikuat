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
        Schema::create('laporan_bulanan_konsultan_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('laporan_mingguan_konsultan_id')->unsigned();
            $table->string('kd_jenis_pekerjaan');
            $table->string('nmp');
            $table->string('volume');
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
        Schema::dropIfExists('laporan_bulanan_konsultan_details');
    }
};
