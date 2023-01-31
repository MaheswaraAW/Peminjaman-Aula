<?php

namespace App\Http\Controllers;

use App\Seksi;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getSeksi(Request $request)
    {
        if ($request->ajax()) {
            $seksi = Seksi::where('kode_bidang', '=', $request->bidang)->get();
            return response()->json($seksi);
        }
    }
}