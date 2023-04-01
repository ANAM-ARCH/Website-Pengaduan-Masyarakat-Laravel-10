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
        Schema::create('tanggapan', function (Blueprint $table) {
            $table->id('id_tanggapan');
            $table->unsignedBigInteger('id_pengaduan')->required();
            $table->timestamp('tgl_tanggapan');
            $table->text('tanggapan')->required();
            $table->unsignedBigInteger('id_petugas')->required();
            $table->foreign('id_pengaduan')->references('id_pengaduan')->on('pengaduan')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tanggapan', function (Blueprint $table) {
            $table->dropForeign(['id_pengaduan']);
            $table->dropColumn('id_pengaduan');
        });
        Schema::dropIfExists('tanggapan');
    }
};
