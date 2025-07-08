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
            $table->string('data_umum_id');
            $table->bigInteger('kontraktor_id');
            $table->integer('periode');
            $table->text('text_a1')->nullable();
            $table->float('a_1')->nullable();
            $table->text('text_a2')->nullable();
            $table->float('a_2')->nullable();
            $table->text('text_a3')->nullable();
            $table->float('a_3')->nullable();
            $table->text('text_a4')->nullable();
            $table->float('a_4')->nullable();
            $table->float('a_bobot')->nullable();
            $table->float('a_total')->nullable();
            $table->text('text_b1')->nullable();
            $table->float('b_1')->nullable();
            $table->text('text_b2')->nullable();
            $table->float('b_2')->nullable();
            $table->text('text_b3')->nullable();
            $table->float('b_3')->nullable();
            $table->text('text_b4')->nullable();
            $table->float('b_4')->nullable();
            $table->text('text_b5')->nullable();
            $table->float('b_5')->nullable();
            $table->text('text_b6')->nullable();
            $table->float('b_6')->nullable();
            $table->text('text_b7')->nullable();
            $table->float('b_7')->nullable();
            $table->text('text_b8')->nullable();
            $table->float('b_8')->nullable();
            $table->text('text_b9')->nullable();
            $table->float('b_9')->nullable();
            $table->text('text_b10')->nullable();
            $table->float('b_10')->nullable();
            $table->text('text_b11')->nullable();
            $table->float('b_11')->nullable();
            $table->text('text_b12')->nullable();
            $table->float('b_12')->nullable();
            $table->text('text_b13')->nullable();
            $table->float('b_13')->nullable();
            $table->text('text_b14')->nullable();
            $table->float('b_14')->nullable();
            $table->text('text_b15')->nullable();
            $table->float('b_15')->nullable();
            $table->text('text_b16')->nullable();
            $table->float('b_16')->nullable();
            $table->text('text_b17')->nullable();
            $table->float('b_17')->nullable();
            $table->float('b_bobot')->nullable();
            $table->float('b_total')->nullable();
            $table->text('text_c1')->nullable();
            $table->float('c_1')->nullable();
            $table->text('text_c2')->nullable();
            $table->float('c_2')->nullable();
            $table->text('text_c3')->nullable();
            $table->float('c_3')->nullable();
            $table->text('text_c4')->nullable();
            $table->float('c_4')->nullable();
            $table->text('text_c5')->nullable();
            $table->float('c_5')->nullable();
            $table->text('text_c6')->nullable();
            $table->float('c_6')->nullable();
            $table->float('c_bobot')->nullable();
            $table->float('c_total')->nullable();
            $table->text('text_d1')->nullable();
            $table->float('d_1')->nullable();
            $table->text('text_d2')->nullable();
            $table->float('d_2')->nullable();
            $table->text('text_d3')->nullable();
            $table->float('d_3')->nullable();
            $table->text('text_d4')->nullable();
            $table->float('d_4')->nullable();
            $table->text('text_d5')->nullable();
            $table->float('d_5')->nullable();
            $table->text('text_d6')->nullable();
            $table->float('d_6')->nullable();
            $table->float('d_bobot')->nullable();
            $table->float('d_total')->nullable();
            $table->float('nilai')->nullable();
            $table->float('bobot')->nullable();
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
