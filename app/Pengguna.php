<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    //
    protected $table = 'pengguna';

    protected $fillable = [
        'username', 'password', 'nama', 'level', 'bidang', 'seksi'
    ];

    public function ref_bidang()
    {
        return $this->belongsTo('App\Bidang', 'bidang', 'kode_bidang');
    }
    public function ref_seksi()
    {
        return $this->belongsTo('App\Seksi', 'seksi', 'kode_seksi');
    }
}