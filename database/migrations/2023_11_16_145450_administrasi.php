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
        Schema::create('administrasi', function (Blueprint $table) {
            $table->id('administrasi_id');
            $table->foreignId('kebutuhan_id');
            $table->enum('urgenci', ['urgent', 'megium', 'low']);
            $table->string('kategori');
            $table->enum('progres', ['dipelajari', 'dikerjakan', 'selesai', 'dicanangkan']);
            $table->timestamps();
            $table->foreign('kebutuhan_id')->references('kebutuhan_id')->on('kebutuhan')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('administrasi');
    }
};
