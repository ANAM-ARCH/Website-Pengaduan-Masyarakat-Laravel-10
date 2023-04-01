<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id('id');
            $table->char('id_petugas')->default(0);
            $table->char('nik', 16)->nullable()->default(0);
            $table->string('nama', 35)->required();
            $table->string('username', 25)->unique()->required();
            $table->string('password');
            $table->string('telp', 15)->unique();
            $table->tinyInteger('type')->default(0);
            $table->enum('jenis', ['bencana', 'agama', 'ekonomi', 'politik'])->nullable();
            $table->timestamp('last_seen');
            $table->timestamp('email_verified_at')->nullable();

            /* Users: 0=>User, 1=>Admin, 2=>Manager */
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
}
