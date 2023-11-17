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
        Schema::create('penanggung_jawab', function (Blueprint $table) {
            $table->id('penanggung_jawab_id');
            $table->foreignId('administrasi_id');
            $table->string('pic', 50);
            $table->timestamps();
            $table->foreign('administrasi_id')->references('administrasi_id')->on('administrasi')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('penanggung_jawab');
    }
};
