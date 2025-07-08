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
        Schema::create('penilaian_penyedias', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('data_umum_id')->unsigned();
            $table->bigInteger('kontraktor_id')->unsigned();
            $table->integer('periode');
            $table->string('a_1')->nullable();
            $table->string('a_2')->nullable();
            $table->string('a_3')->nullable();
            $table->string('a_4')->nullable();
            $table->string('a_bobot')->nullable();
            $table->string('a_total')->nullable();
            $table->string('b_1')->nullable();
            $table->string('b_2')->nullable();
            $table->string('b_3')->nullable();
            $table->string('b_4')->nullable();
            $table->string('b_5')->nullable();
            $table->string('b_6')->nullable();
            $table->string('b_7')->nullable();
            $table->string('b_8')->nullable();
            $table->string('b_9')->nullable();
            $table->string('b_10')->nullable();
            $table->string('b_11')->nullable();
            $table->string('b_12')->nullable();
            $table->string('b_13')->nullable();
            $table->string('b_14')->nullable();
            $table->string('b_15')->nullable();
            $table->string('b_16')->nullable();
            $table->string('b_17')->nullable();
            $table->string('b_bobot')->nullable();
            $table->string('b_total')->nullable();
            $table->string('c_1')->nullable();
            $table->string('c_2')->nullable();
            $table->string('c_3')->nullable();
            $table->string('c_4')->nullable();
            $table->string('c_5')->nullable();
            $table->string('c_6')->nullable();
            $table->string('c_bobot')->nullable();
            $table->string('c_total')->nullable();
            $table->string('d_1')->nullable();
            $table->string('d_2')->nullable();
            $table->string('d_3')->nullable();
            $table->string('d_4')->nullable();
            $table->string('d_5')->nullable();
            $table->string('d_6')->nullable();
            $table->string('d_bobot')->nullable();
            $table->string('d_total')->nullable();
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
        Schema::dropIfExists('penilaian_penyedias');
    }
};
