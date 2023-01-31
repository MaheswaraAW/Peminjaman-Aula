<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_bidang');
            $table->string('kode_seksi');
            $table->string('detail_seksi');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('kode_bidang')->references('kode_bidang')->on('bidangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seksis');
    }
}