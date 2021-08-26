<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRapatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama')->nullable();
            $table->string('kepala')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('title', 200)->nullable();
            $table->string('filename', 100);
            $table->string('keterangan',500)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rapat');
    }
}
