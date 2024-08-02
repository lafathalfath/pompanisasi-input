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
        Schema::create('pompa_abt', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pompanisasi_id')->unsigned()->unique();
            $table->integer('usulan')->default(0);
            $table->integer('diterima')->default(0);
            $table->integer('digunakan')->default(0);
            $table->timestamps();

            $table->foreign('pompanisasi_id')->references('id')->on('pompanisasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pompa_abt');
    }
};
