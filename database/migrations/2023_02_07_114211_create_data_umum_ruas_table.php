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
        Schema::create('data_umum_ruas', function (Blueprint $table) {
            $table->string('data_umum_detail_id');
            $table->string('ruas_id');
            $table->string('segment_jalan');
            $table->string('lat_awal');
            $table->string('long_awal');
            $table->string('lat_akhir');
            $table->string('long_akhir');
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
        Schema::dropIfExists('data_umum_ruas');
    }
};
