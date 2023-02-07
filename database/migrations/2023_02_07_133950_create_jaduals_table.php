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
        Schema::create('jaduals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('data_umum_detail_id')->unsigned();
            $table->string('nmp');
            $table->string('uraian');
            $table->string('total_harga');
            $table->string('total_volume');
            $table->string('satuan');
            $table->string('bobot');
            $table->string('harga_satuan');
            $table->bigInteger('koefisien');
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
        Schema::dropIfExists('jaduals');
    }
};
