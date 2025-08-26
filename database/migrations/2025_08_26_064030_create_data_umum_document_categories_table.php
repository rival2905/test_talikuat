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
        Schema::create('data_umum_document_categories', function (Blueprint $table) {
            $table->id();

            $table->string('data_umum_id', 100)->index();

            $table->unsignedBigInteger('document_category_id')->index();

            $table->integer('score')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->longText('deskripsi')->nullable();

            $table->timestamps();

            $table->unique(['data_umum_id', 'document_category_id'], 'du_dc_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_umum_document_categories');
    }
};
