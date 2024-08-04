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
        Schema::create('pompa_abt_kec_diterima', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pompanisasi_kec_id')->unsigned()->unique();
            $table->string('nama_poktan');
            $table->string('no_hp_poktan')->nullable();
            $table->integer('luas_lahan')->default(0);
            $table->integer('pompa_3_inch')->default(0);
            $table->integer('pompa_4_inch')->default(0);
            $table->integer('pompa_6_inch')->default(0);
            $table->date('tanggal')->unique();
            $table->timestamps();

            $table->foreign('pompanisasi_kec_id')->references('id')->on('pompanisasi_kec');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pompa_abt_kec_diterima');
    }
};
