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
        Schema::create('user_externals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('nik')->unique();
            $table->string('password');
            $table->integer('uptd_id');
            $table->integer('kontraktor_id')->nullable();
            $table->integer('konsultan_id')->nullable();
            $table->string('jabatan');
            $table->string('role');
            $table->boolean('is_active');
            $table->string('avatar');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('user_externals');
    }
};
