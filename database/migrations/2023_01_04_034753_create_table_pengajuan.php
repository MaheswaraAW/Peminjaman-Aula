<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePengajuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('acara');
            $table->string('tempat');
            $table->string('tanggal');
            $table->string('jam_m');
            $table->string('jam_s');
            $table->string('jam_mulai');
            $table->string('jam_selesai');
            $table->string('bidang');
            $table->string('seksi');
            $table->string('pemesan');
            $table->string('keterangan');
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
        Schema::dropIfExists('pengajuan');
    }
}
