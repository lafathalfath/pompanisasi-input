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
        Schema::create('pompa_ref_diterima', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pompanisasi_id')->unsigned()->unique();
            $table->integer('pompa_3_inch')->unsigned();
            $table->integer('pompa_4_inch')->unsigned();
            $table->integer('pompa_6_inch')->unsigned();
            $table->integer('total_unit')->unsigned();
            $table->timestamps();

            $table->foreign('pompanisasi_id')->references('id')->on('pompanisasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pompa_ref_diterima');
    }
};