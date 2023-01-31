<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Pengguna;
use App\Pengajuan;
use App\Teksberjalan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;





class LoginController extends Controller
{
    public function viewlogin()
    {
        session()->forget('username');

        return view('login');
    }
    public function viewregister()
    {
        return view('register');
    }
    public function postLogin(Request $request)
    {
        $pengguna = Pengguna::where('username', request('username'))->first();
        $level = Pengguna::where('username', request('username'))->value('level');
        $user_pass_error = "Username atau Password Salah";
        // dd($level);
        $pengajuan = Pengajuan::all();
        if ($pengguna && Hash::check($request->password, $pengguna->password) && $level == 0) {
            session()->put(array(
                'username' => $pengguna->username,
                'name' => $pengguna->nama,
                'bidang' => $pengguna->bidang,
                'seksi' => $pengguna->seksi
            ));

            return redirect('pengajuan');
        } else if ($pengguna && Hash::check($request->password, $pengguna->password) && $level == 1) {
            session()->put(array(
                'username' => $pengguna->username,
                'name' => $pengguna->nama,
                'bidang' => $pengguna->bidang,
                'seksi' => $pengguna->seksi
            ));

            return redirect('pengajuan');
        }
        // return redirect('login');
        return view('login', compact('user_pass_error'));
    }

    public function postDaftar(Request $request)
    {
        // dd($request->all());
        $pass_crypt = Hash::make($request->password);

        $username = Pengguna::where('username', request('username'))->first();

        if ($username) {
            $cek = 1;
            return view('register', compact('cek'));
        }
        Pengguna::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $pass_crypt,
            'level' => 1,
        ]);

        $msg = "Berhasil Daftar";

        echo "<script>alert('Berhasil Daftar');window.location.href='login';</script>";

        // return redirect('login');
    }

    public function Agenda()
    {
        // session()->forget('username');

        $dt = Carbon::now()->toDateTimeString();
        // dd($dt); //2023-01-05 jam:menit:detik
        $tgl = explode(" ", $dt);
        $tgl2 = explode("-", $tgl[0]);
        $tgl3 = $tgl2[2] . "/" . $tgl2[1] . "/" . $tgl2[0];
        // $pengajuan = Pengajuan::all();

        // $video_pertama = Profile::first()->value('video');
        // $nama_pertama = Profile::first()->value('nama');
        // $teks_berjalan = Profile::first()->value('teks_berjalan');
        // dd($nama_pertama);

        $pengajuan = Pengajuan::where('tanggal', $tgl3)->orderBy('jam_m', 'ASC')->get();

        $profile = Profile::all();
        $teksberjalan = Teksberjalan::first();
        $teks_berjalan = $teksberjalan->teks;

        // dd($pengajuan);

        return view('agenda', compact('pengajuan', 'tgl3', 'dt', 'profile', 'teks_berjalan'));
    }

    public function Logout()
    {
        session()->forget('username');

        return redirect('login');
    }
}