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
        Schema::create('pompanisasi_kec', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('desa_id')->unsigned();
            $table->integer('luas_lahan')->default(0);
            $table->bigInteger('pompa_ref_kec_usulan_id')->unsigned()->unique()->nullable();
            $table->bigInteger('pompa_ref_kec_diterima_id')->unsigned()->unique()->nullable();
            $table->bigInteger('pompa_ref_kec_digunakan_id')->unsigned()->unique()->nullable();
            $table->bigInteger('pompa_abt_kec_usulan_id')->unsigned()->unique()->nullable();
            $table->bigInteger('pompa_abt_kec_diterima_id')->unsigned()->unique()->nullable();
            $table->bigInteger('pompa_abt_kec_digunakan_id')->unsigned()->unique()->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();

            $table->foreign('desa_id')->references('id')->on('desa');
            $table->foreign('pompa_ref_kec_usulan_id')->references('id')->on('pompa_ref_kec_usulan');
            $table->foreign('pompa_ref_kec_diterima_id')->references('id')->on('pompa_ref_kec_diterima');
            $table->foreign('pompa_ref_kec_digunakan_id')->references('id')->on('pompa_ref_kec_digunakan');
            $table->foreign('pompa_abt_kec_usulan_id')->references('id')->on('pompa_abt_kec_usulan');
            $table->foreign('pompa_abt_kec_diterima_id')->references('id')->on('pompa_abt_kec_diterima');
            $table->foreign('pompa_abt_kec_digunakan_id')->references('id')->on('pompa_abt_kec_digunakan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pompanisasi_kec');
    }
};
