<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';

    // protected $casts = [
    // 	'menit_mulai'=>'integer'
    // ];

    protected $fillable = [
        'acara', 'tempat', 'tanggal', 'jam_m', 'jam_s', 'jam_mulai', 'jam_selesai', 'bidang', 'seksi', 'pemesan', 'keterangan'
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