<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id_petugas = uniqid();
        $users = [
            [
                'id_petugas'=>'ALPHA',
               'nama'=>'Alpha',
               'username'=>'admin',
               'type'=>'1',
               'last_seen'=>Carbon::now(),
               'telp' =>'08963746784221',
               'password'=> bcrypt('12345678'),
            ],
            [
                'id_petugas'=>$id_petugas,
               'nama'=>'Jack',
               'username'=>'bencana',
               'type'=>'2',
               'last_seen'=>Carbon::now(),
               'jenis'=>'bencana',
               'telp'=>'08963746784443',
               'password'=> bcrypt('12345678'),
            ],
            [
                'id_petugas'=>$id_petugas,
               'nama'=>'Tony',
               'username'=>'ekonomi',
               'type'=>'2',
               'last_seen'=>Carbon::now(),
               'jenis'=>'ekonomi',
               'telp'=>'08963745784243',
               'password'=> bcrypt('12345678'),
            ],
            [
                'id_petugas'=>$id_petugas,
               'nama'=>'Jeff',
               'username'=>'agama',
               'type'=>'2',
               'last_seen'=>Carbon::now(),
               'jenis'=>'agama',
               'telp'=>'08963740784243',
               'password'=> bcrypt('12345678'),
            ],
            [
                'id_petugas'=>$id_petugas,
               'nama'=>'Kyle',
               'username'=>'politik',
               'type'=>'2',
               'last_seen'=>Carbon::now(),
               'jenis'=>'politik',
               'telp'=>'08963726784243',
               'password'=> bcrypt('12345678'),
            ],
            [
                'nik'=> 2407859387834982,
               'nama'=>'user',
               'type'=>'0',
               'last_seen'=>Carbon::now(),
               'username'=>'user',
               'telp'=>'08963967842535',
               'password'=> bcrypt('12345678'),
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
