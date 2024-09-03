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
        Schema::create('starter_ref_dimanfaatkan_kabupaten', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kabupaten_id')->unsigned()->unique();
            $table->integer('total_unit')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('kabupaten_id')->references('id')->on('kabupaten')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('starter_ref_dimanfaatkan_kabupaten');
    }
};
