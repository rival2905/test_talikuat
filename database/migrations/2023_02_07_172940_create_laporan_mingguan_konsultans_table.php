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
        Schema::create('laporan_mingguan_konsultans', function (Blueprint $table) {
            $table->id();
            $table->string('data_umum_id');
            $table->string('rencana');
            $table->string('realisasi');
            $table->string('deviasi');
            $table->string('priode');
            $table->string('file_path');
            $table->string('tgl_start');
            $table->string('tgl_end');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('laporan_mingguan_konsultans');
    }
};
