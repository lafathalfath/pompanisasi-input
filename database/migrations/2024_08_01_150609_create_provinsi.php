<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('provinsi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pj_provinsi_id')->unsigned()->nullable();
            $table->bigInteger('wilayah_id')->unsigned();
            $table->string('nama');
            $table->timestamps();

            $table->foreign('pj_provinsi_id')->references('id')->on('users');
            $table->foreign('wilayah_id')->references('id')->on('wilayah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinsi');
    }
};
