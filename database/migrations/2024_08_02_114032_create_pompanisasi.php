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
        Schema::create('pompanisasi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kabupaten_id')->unsigned();
            $table->bigInteger('poktan_id')->unsigned();
            $table->integer('luas_lahan')->default(0);
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();

            $table->foreign('kabupaten_id')->references('id')->on('kabupaten');
            $table->foreign('poktan_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pompanisasi');
    }
};
