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
        Schema::create('provinsi_dashboard', function (Blueprint $table) {
            $table->id();
            $table->string('provinsi');
            $table->string('nama_poktan')->nullable();
            $table->integer('luas_tanam')->default(0);
            $table->integer('pompa_refocusing_usulan')->default(0);
            $table->integer('pompa_refocusing_diterima')->default(0);
            $table->integer('pompa_refocusing_digunakan')->default(0);
            $table->integer('pompa_abt_usulan')->default(0);
            $table->integer('pompa_abt_diterima')->default(0);
            $table->integer('pompa_abt_digunakan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinsi_dashboards');
    }
};
