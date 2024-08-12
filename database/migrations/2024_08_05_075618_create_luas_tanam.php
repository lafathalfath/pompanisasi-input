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
        Schema::create('luas_tanam', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('desa_id')->unsigned();
            $table->string('nama_poktan');
            $table->float('luas_tanam');
            $table->string('no_hp_poktan')->nullable();
            $table->date('tanggal');
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
        Schema::dropIfExists('luas_tanam');
    }
};
