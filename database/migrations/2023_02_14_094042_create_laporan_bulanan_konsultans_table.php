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
        Schema::create('laporan_bulanan_konsultans', function (Blueprint $table) {
            $table->id();
            $table->string('data_umum_id');
            $table->string('rencana');
            $table->string('realisasi');
            $table->string('deviasi');
            $table->date('periode');
            $table->string('file_path');
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
        Schema::dropIfExists('laporan_bulanan_konsultans');
    }
};
