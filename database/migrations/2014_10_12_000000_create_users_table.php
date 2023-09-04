<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim');
            $table->string('noHP');
            $table->string('email');
            $table->string('institusi');
            $table->string('fakultas');
            $table->string('jurusan');
            $table->string('waktu_mulai');
            $table->string('waktu_selesai');
            $table->string('judul');
            $table->string('file')->nullable();
            $table->string('rekomendasi')->nullable();
            $table->string('surat');
            $table->string('bidang')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};