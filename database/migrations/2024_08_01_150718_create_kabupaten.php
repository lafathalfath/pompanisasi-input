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
        Schema::create('kabupaten', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pj_id')->unsigned()->unique()->nullable();
            $table->bigInteger('provinsi_id')->unsigned();
            $table->string('nama');
            $table->timestamps();

            $table->foreign('pj_id')->references('id')->on('users');
            $table->foreign('provinsi_id')->references('id')->on('provinsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kabupaten');
    }
};
