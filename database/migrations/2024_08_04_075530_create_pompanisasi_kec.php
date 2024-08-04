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
            $table->date('tanggal')->unique();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();

            $table->foreign('desa_id')->references('id')->on('desa');
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
