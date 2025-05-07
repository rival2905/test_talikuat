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
        Schema::create('foto_laporan_mingguan_konsultans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('laporan_id')->unsigned();
            $table->foreign('laporan_id')->references('id')->on('laporan_mingguan_konsultans')->onDelete('cascade');
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('foto_laporan_mingguan_konsultans');
    }
};
