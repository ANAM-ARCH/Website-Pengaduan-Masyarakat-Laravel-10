<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    protected $table = 'tanggapan';
    protected $fillable = [
        'id_petugas', 'id_pengaduan', 'tanggapan'
    ];
    protected $primaryKey ='id_tanggapan';
    public $timestamps = false;

    // protected $primaryKey = 'title';

    // protected $timeStamps = 'false';

    // protected $dateTime = 'U';

    // protected $connecttion = 'sqlite';

    // protected $attributes = [
    //     'is_published' => true
    // ];
}
