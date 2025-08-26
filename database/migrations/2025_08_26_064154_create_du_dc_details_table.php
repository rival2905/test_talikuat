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
        Schema::create('du_dc_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('du_dc_id')->index();
            $table->string('name', 150);
            $table->string('files', 255)->nullable(); 
            $table->integer('score')->default(0);
            $table->timestamps();
            $table->foreign('du_dc_id')
                  ->references('id')->on('data_umum_document_categories')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->bigInteger('created_by')->unsigned();
            $table->bigInteger('updated_by')->unsigned();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('du_dc_details');
    }
};
