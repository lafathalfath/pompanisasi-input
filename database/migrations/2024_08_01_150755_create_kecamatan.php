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
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pj_kecamatan_id')->unsigned()->nullable();
            $table->bigInteger('kabupaten_id')->unsigned();
            $table->string('nama');
            $table->integer('potensi_pompanisasi')->nullable();
            $table->integer('hujan_kepmentan')->nullable();
            $table->timestamp('verified_by_kabupaten')->nullable();
            $table->timestamp('verified_by_provinsi')->nullable();
            $table->timestamp('verified_by_wilayah')->nullable();
            $table->timestamps();

            $table->foreign('pj_kecamatan_id')->references('id')->on('users');
            $table->foreign('kabupaten_id')->references('id')->on('kabupaten');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kecamatan');
    }
};
