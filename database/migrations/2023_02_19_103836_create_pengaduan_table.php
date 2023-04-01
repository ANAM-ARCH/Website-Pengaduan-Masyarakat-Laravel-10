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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id('id_pengaduan');
            $table->char('bln_pengaduan');
            $table->unsignedBigInteger('id');
            $table->enum('jenis', ['bencana', 'agama', 'ekonomi', 'politik'])->required();
            $table->string('lokasi')->required();
            $table->string('judul')->required();
            $table->text('isi_laporan')->required();
            $table->string('foto')->required();
            $table->string('tgl_pengaduan')->required();
            $table->string('waktu_pengaduan')->required();
            $table->enum('status', [0, 'proses', 'selesai', 'cancelled'])->default(0);
            $table->foreign('id')->references('id')->on('users');
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
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->dropForeign(['nik']);
            $table->dropColumn('nik');
        });
        Schema::dropIfExists('pengaduan');
    }
};
