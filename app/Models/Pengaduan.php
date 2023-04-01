<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    protected $fillable = [
        'jenis', 'judul', 'isi_laporan', 'foto', 'status', 'lokasi', 'id', 'bln_pengaduan', 'tgl_pengaduan', 'waktu_pengaduan'
    ];
    protected $primaryKey ='id_pengaduan';

    // protected $primaryKey = 'title';

    protected $timeStamps = 'false';

    // protected $dateTime = 'U';

    // protected $connecttion = 'sqlite';

    // protected $attributes = [
    //     'is_published' => true
    // ];
}
