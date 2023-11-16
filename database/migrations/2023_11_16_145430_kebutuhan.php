<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kebutuhan', function (Blueprint $table) {
            $table->id('kebutuhan_id');
            $table->foreignId('pegawai_id');
            $table->enum('jenis_kebutuhan', ['SIMRS', 'NON-SIMRS']);
            $table->string('kebutuhan_tentang', 100);
            $table->string('deskripsi_kebutuhan', 255);
            $table->string('foto_video', 75);
            $table->timestamps();
            $table->foreign('pegawai_id')->references('pegawai_id')->on('pegawai')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kebutuhan');
    }
};
