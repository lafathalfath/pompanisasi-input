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
        Schema::create('cpcl', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('desa_id')->unsigned();
            $table->bigInteger('poktan_id')->unsigned();
            $table->string('url_gambar');
            $table->date('tanggal')->unique();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();

            $table->foreign('desa_id')->references('id')->on('desa');
            $table->foreign('poktan_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpcl');
    }
};
