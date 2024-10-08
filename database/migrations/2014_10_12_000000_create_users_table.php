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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('no_hp')->unique();
            $table->bigInteger('role_id')->unsigned();
            $table->bigInteger('region_id')->unsigned()->nullable();
            $table->string('password');
            $table->enum('status_verifikasi', ['proses', 'terverifikasi', 'ditolak'])->default('proses');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
