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
        Schema::create('pompa_abt_dimanfaatkan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pompa_abt_diterima_id')->unsigned()->unique();
            $table->string('nama_poktan');
            $table->float('luas_lahan');
            $table->integer('pompa_3_inch')->unsigned();
            $table->integer('pompa_4_inch')->unsigned();
            $table->integer('pompa_6_inch')->unsigned();
            $table->integer('total_unit')->unsigned();
            $table->string('no_hp_poktan')->nullable();
            $table->string('url_gambar');
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('pompa_abt_diterima_id')->references('id')->on('pompa_abt_diterima')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pompa_abt_dimanfaatkan');
    }
};
