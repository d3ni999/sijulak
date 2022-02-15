<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalKegiatanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_kegiatan_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('kegiatan_id');
            $table->unsignedInteger('user_id');
            $table->enum('absen', ['hadir', 'tidak hadir', 'belum absen'])->default('belum absen');
            $table->text('keterangan')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users');

            // $table->foreign('jadwal_kegiatan_id')->references('id')->on('jadwal_kegiatans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_kegiatan_details');
    }
}
