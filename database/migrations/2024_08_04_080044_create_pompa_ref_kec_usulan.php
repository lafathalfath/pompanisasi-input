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
        Schema::create('pompa_ref_kec_usulan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_poktan');
            $table->string('no_hp_poktan')->nullable();
            $table->integer('luas_lahan')->default(0);
            $table->integer('pompa_3_inch')->default(0);
            $table->integer('pompa_4_inch')->default(0);
            $table->integer('pompa_6_inch')->default(0);
            $table->date('tanggal')->default(date('Y-m-d'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pompa_ref_kec_usulan');
    }
};
