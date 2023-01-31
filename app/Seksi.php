<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seksi extends Model
{
    use SoftDeletes;

    protected $fillable = ['kode_bidang', 'kode_seksi', 'detail_seksi'];
}