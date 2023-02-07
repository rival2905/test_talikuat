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
        Schema::create('jadual_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jadual_id')->unsigned();
            $table->foreign('jadual_id')->references('id')->on('jaduals')->onDelete('cascade');
            $table->string('nmp');
            $table->string('uraian');
            $table->string('harga_satuan');
            $table->string('volume');
            $table->string('satuan');
            $table->string('bobot');
            $table->date('tanggal');
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
        Schema::dropIfExists('jadual_details');
    }
};
