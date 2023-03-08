<?php

namespace App\Http\Controllers;

use App\Bidang;
use Illuminate\Http\Request;
use App\Pengajuan;
use App\Pengguna;
use App\Seksi;
// use App\Tempat;
// use Carbon\Carbon;
use Carbon\Carbon;
use DataTables;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    public function index(Request $request)
    {
        // username sekarang untuk sidebar
        $ses_user = session()->get('username');
        // dd($ses_user);

        // hilangkan sesion cek jam pada create
        // session()->forget('cek_jam');

        $pengguna = Pengguna::where('username', $ses_user)->first();
        // $pengajuan = Pengajuan::all();

        // tanggal jam sekarang
        $dt = Carbon::now()->toDateTimeString();
        // tahun-bulan-hari jam:menit:detik
        // 2023-01-15 15:03:30
        $tgl = explode(" ", $dt);
        // [0]2023-01-15 [1]15:03:30
        $tgl2 = explode("-", $tgl[0]);
        // [0]2023 [1]01 [2]15
        $tgl3 = $tgl2[2] . "/" . $tgl2[1] . "/" . $tgl2[0];
        // 15/01/2023

        // dd($tgl3);

        // cek level
        $level = Pengguna::where('username', $ses_user)->value('level');
        // dd($level);
        // if($ses_user!=null){
        if ($level == 0) {
            // $pengajuan = Pengajuan::where('tanggal', $tgl3)->orderBy('jam_m', 'ASC')->get();
            if ($request->ajax()) {
            // $data = Pengguna::latest()->get();
                $pengajuan = Pengajuan::where('tanggal', $tgl3)->orderBy('jam_mulai', 'DESC')->get();
                return DataTables::of($pengajuan)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                               $btn = '
                                <a class="btn btn-info" href="pengajuan/edit/'.$row->id.'">Edit</a>
                                <a class="btn btn-danger" href="delete/'.$row->id.'">Delete</a>';
         
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
            // $pengajuan = Pengajuan::where('tanggal', $tgl3)->orderBy('jam_m', 'ASC')->get();
            $bghariini = "ada";

            // return view('admin.pengajuan.dashboard', compact('pengajuan', 'pengguna', 'bghariini'));
            return view('admin.pengajuan.dashboard', compact('pengguna', 'bghariini'));
        } else {
            if (!empty($pengguna->seksi)) {
                $pengajuan = Pengajuan::where('pemesan', $ses_user)->where('jam_mulai', $tgl3)->orderBy('jam_m', 'ASC')->get();
            } else {
                $pengajuan = Pengajuan::where('bidang', session()->get('bidang'))->where('jam_mulai', $tgl3)->orderBy('jam_m', 'ASC')->get();
            }
            // return view('pengguna.dashboard', compact('pengajuan', 'pengguna'));
            $bghariini = "ada";
            // $pengajuan = Pengajuan::where('tanggal', $tgl3)->orderBy('jam_m', 'ASC')->get();
            if ($request->ajax()) {
                return DataTables::of($pengajuan)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                               $btn = '
                                <a class="btn btn-info" href="pengajuan/edit/'.$row->id.'">Edit</a>
                                <a class="btn btn-danger" href="delete/'.$row->id.'">Delete</a>';
         
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
            return view('pengguna.pengajuan.daftarSaya', compact('pengajuan', 'pengguna', 'bghariini'));
        }
        // }
        // return view('Agenda', compact('pengajuan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // user sekarang untuk sidebar
        $ses_user = session()->get('username');

        // username untuk create pemesan
        $pengguna = Pengguna::where('username', $ses_user)->first();
        $level = Pengguna::where('username', $ses_user)->value('level');
        $bidang = Bidang::all();
        if (!empty($pengguna->seksi))
            $seksi = Seksi::where('kode_seksi', '=', session()->get('seksi'))->get();
        else {
            $seksi = Seksi::where('kode_bidang', '=', session()->get('bidang'))->get();
        }
        if ($level == 0) {
            return view('admin.pengajuan.create', compact('pengguna', 'bidang', 'seksi'));
        }
        return view('pengguna.pengajuan.tambah', compact('pengguna', 'bidang', 'seksi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        //cek array tempat

        if (sizeof($request->tempat) == 4) {
            if (array_search("Ruang Rapat Lt 9", $request->tempat)) {
                // dd($request->tempat);
                $aula4 = " & " . $request->tempat[3];
                // dd($aula3);
            } else {
                $aula4 = "";
            }
            $aula2 = str_replace("Aula ", "", $request->tempat[1]);
            $aula3 = str_replace("Aula ", "", $request->tempat[2]);

            // $tempat=$request->tempat[0].$aula2.$aula3;
            // $tempat="Aula ABC";
            $tempat = $request->tempat[0] . " " . $aula2 . " " . $aula3 . $aula4;
            // $tempat="Aula ABC";
            // dd($tempat);
            // dd($request->tempat);
        }
        //[0] Aula A [1] Aula B [2] Aula C
        if (sizeof($request->tempat) == 3) {
            // dd($request->tempat);
            if (array_search("Ruang Rapat Lt 9", $request->tempat)) {
                // dd($request->tempat);
                $aula3 = "& " . $request->tempat[2];
                // dd($aula3);
            } else {
                //buang kata Aula
                // $aula2=str_replace("Aula ", "", $request->tempat[1]);
                $aula3 = str_replace("Aula ", "", $request->tempat[2]);
            }
            $aula2 = str_replace("Aula ", "", $request->tempat[1]);
            // $tempat=$request->tempat[0].$aula2.$aula3;
            // $tempat="Aula ABC";
            $tempat = $request->tempat[0] . " " . $aula2 . " " . $aula3;
            // $tempat="Aula ABC";
            // dd($tempat);
        }
        if (sizeof($request->tempat) == 2) {
            // if($request->tempat)
            if (array_search("Ruang Rapat Lt 9", $request->tempat)) {
                // dd($request->tempat);
                $aula2 = "& " . $request->tempat[1];
                // dd($aula2);
            } else {
                $aula2 = str_replace("Aula ", "", $request->tempat[1]);
            }
            // dd($request->tempat);

            // $tempat=$request->tempat[0].$aula2;

            $tempat = $request->tempat[0] . " " . $aula2;
            // dd($tempat);
        }
        if (sizeof($request->tempat) == 1) {
            $tempat = $request->tempat[0];
            // dd("1");
        }

        //ubah tanggal
        //bulan-hari-tahun
        //hari/bulan/tahun
        $tgl = explode("-", $request->tanggal);
        //[0]tahun [1]bulan [2]hari
        $tgl2 = $tgl[2] . "/" . $tgl[1] . "/" . $tgl[0];
        // $jam_mulai=explode(":",$request->jam_mulai);
        // $jam_selesai=explode(":",$request->jam_selesai);

        // dd($tgl);
        // $c_m=new \DateTime($request->tanggal.$request->jam_mulai);
        // $c_s=new \DateTime($request->tanggal.$request->jam_selesai);
        $c_m = Carbon::parse($request->tanggal . $request->jam_mulai)->toDateTimeString();
        $c_s = Carbon::parse($request->tanggal . $request->jam_selesai)->toDateTimeString();

        if ($request->keterangan == null) {
            $ket = "";
        } else {
            $ket = $request->keterangan;
        }
        // if(sizeof($cek_jam)!=0){
        //     return redirect('pengajuan/create');
        // }
        // else{
        Pengajuan::create([
            'acara' => $request->acara,
            'tempat' => $tempat,
            'tanggal' => $tgl2,
            'jam_m' => $request->jam_mulai,
            'jam_s' => $request->jam_selesai,
            'jam_mulai' => $c_m,
            'jam_selesai' => $c_s,
            'bidang' => $request->bidang,
            'seksi' => $request->seksi,
            'pemesan' => $request->pemesan,
            'keterangan' => $ket
        ]);


        // $ses_user=session()->get('username');
        // $pengguna = Pengguna::where('username', $ses_user)->first();

        // return redirect('pengajuan');
        return redirect('pengajuan')->with('success', 'Tambah Berhasil');
        // }
        // dd($cek_semua, $cek_jam_mulai, $jam_mulai, $jam_selesai);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $ses_user = session()->get('username');
        // $ses_e_jam=session()->get('cek_e_jam');
        $pengguna = Pengguna::where('username', $ses_user)->first();
        // dd($pengguna);
        $pengajuan = Pengajuan::findOrFail($id);
        // dd($pengajuan);
        $tanggal = $pengajuan->tanggal;
        $tgl = explode("/", $tanggal);
        $tgl2 = $tgl[2] . "-" . $tgl[1] . "-" . $tgl[0];
        // dd($tgl2);
        $bidang = Bidang::all();
        $sseksi = Seksi::all();

        if (!empty($pengguna->seksi))
            $seksi = Seksi::where('kode_seksi', '=', session()->get('seksi'))->get();
        else {
            $seksi = Seksi::where('kode_bidang', '=', session()->get('bidang'))->get();
        }
        // if($seksi==""){
        //     $seksi = Seksi::all();
        //     dd("kosong");
        // }
        // dd($pengguna);
        // dd($sseksi);
        if($pengguna->level==1){
            return view('pengguna.pengajuan.edit', compact('pengguna', 'pengajuan', 'tgl2', 'tanggal', 'seksi', 'bidang', 'sseksi'));    
        }
        return view('admin.pengajuan.edit', compact('pengguna', 'pengajuan', 'tgl2', 'tanggal', 'seksi', 'bidang', 'sseksi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $pengajuan = Pengajuan::findOrFail($id);
        $tgl = explode("-", $request->tanggal);
        $tgl2 = $tgl[2] . "/" . $tgl[1] . "/" . $tgl[0];
        $jam = $request->jam_mulai . "-" . $request->jam_selesai;

        $c_m = Carbon::parse($request->tanggal . $request->jam_mulai)->toDateTimeString();
        $c_s = Carbon::parse($request->tanggal . $request->jam_selesai)->toDateTimeString();

        //cek array tempat
        //[0] Aula A [1] Aula B [2] Aula C
        // if($request->tempat==null){
        //     $tempat = $pengajuan->tempat;
        //     // dd($tempat);
        // }
        if (sizeof($request->tempat) == 4) {
            if (array_search("Ruang Rapat Lt 9", $request->tempat)) {
                // dd($request->tempat);
                $aula4 = " & " . $request->tempat[3];
                // dd($aula3);
            } else {
                $aula4 = "";
            }
            $aula2 = str_replace("Aula ", "", $request->tempat[1]);
            $aula3 = str_replace("Aula ", "", $request->tempat[2]);

            // $tempat=$request->tempat[0].$aula2.$aula3;
            // $tempat="Aula ABC";
            $tempat = $request->tempat[0] . " " . $aula2 . " " . $aula3 . $aula4;
            // $tempat="Aula ABC";
            // dd($tempat);
            // dd($request->tempat);
        }
        //[0] Aula A [1] Aula B [2] Aula C
        if (sizeof($request->tempat) == 3) {
            // dd($request->tempat);
            if (array_search("Ruang Rapat Lt 9", $request->tempat)) {
                // dd($request->tempat);
                $aula3 = "& " . $request->tempat[2];
                // dd($aula3);
            } else {
                //buang kata Aula
                // $aula2=str_replace("Aula ", "", $request->tempat[1]);
                $aula3 = str_replace("Aula ", "", $request->tempat[2]);
            }
            $aula2 = str_replace("Aula ", "", $request->tempat[1]);
            // $tempat=$request->tempat[0].$aula2.$aula3;
            // $tempat="Aula ABC";
            $tempat = $request->tempat[0] . " " . $aula2 . " " . $aula3;
            // $tempat="Aula ABC";
            // dd($tempat);
        }
        if (sizeof($request->tempat) == 2) {
            // if($request->tempat)
            if (array_search("Ruang Rapat Lt 9", $request->tempat)) {
                // dd($request->tempat);
                $aula2 = "& " . $request->tempat[1];
                // dd($aula2);
            } else {
                $aula2 = str_replace("Aula ", "", $request->tempat[1]);
            }
            // dd($request->tempat);

            // $tempat=$request->tempat[0].$aula2;

            $tempat = $request->tempat[0] . " " . $aula2;
            // dd($tempat);
        }
        if (sizeof($request->tempat) == 1) {
            $tempat = $request->tempat[0];
            // dd("1");
        }



        if ($request->keterangan == null) {
            $ket = "";
        } else {
            $ket = $request->keterangan;
        }

        $ar = ([
            'acara' => $request->acara,
            'tempat' => $tempat,
            'tanggal' => $tgl2,
            'jam_m' => $request->jam_mulai,
            'jam_s' => $request->jam_selesai,
            'jam_mulai' => $c_m,
            'jam_selesai' => $c_s,
            'bidang' => $request->bidang,
            'seksi' => $request->seksi,
            'pemesan' => $request->pemesan,
            'keterangan' => $ket
        ]);
        // $pengajuan->update($request->all());
        $pengajuan->update($ar);
        // dd($pengajuan);

        return redirect('pengajuan')->with('success', 'Update Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    public function destroy($id, $filter)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->delete();

        // return redirect('pengajuan');
        return redirect('pengajuan/'.$filter)->with('success', 'Hapus Berhasil');
    }

    // public function pengajuansemua()
    public function pengajuansemua(Request $request)
    {
        $pengajuan = Pengajuan::orderBy('jam_mulai', 'ASC')->orderBy('jam_m', 'ASC')->get();

        $ses_user = session()->get('username');

        $pengguna = Pengguna::where('username', $ses_user)->first();

        $level = Pengguna::where('username', $ses_user)->value('level');

        if ($level == 0) {
            if ($request->ajax()) {
                return DataTables::of($pengajuan)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                               $btn = '
                                <a class="btn btn-info" href="edit/'.$row->id.'">Edit</a>
                                <a class="btn btn-danger" href="delete/'.$row->id.'/semua">Delete</a>';
         
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
            $bgsemua = "ada";

            return view('admin.pengajuan.dashboard', compact('pengguna', 'pengajuan', 'bgsemua'));
        }
        // dd($pengajuan);
        if ($request->ajax()) {
            return DataTables::of($pengajuan)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '
                            <a class="btn btn-info" href="edit/'.$row->id.'">Edit</a>
                            <a class="btn btn-danger" href="delete/'.$row->id.'/semua">Delete</a>';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('pengguna.dashboard', compact('pengguna', 'pengajuan'));
    }

    // public function pengajuanhariini()
    // {
    //     $dt = Carbon::now()->toDateTimeString();
    //     // dd($dt); //2023-01-05 jam:menit:detik
    //     $tgl = explode(" ", $dt);
    //     $tgl2 = explode("-", $tgl[0]);
    //     $tgl3 = $tgl2[2] . "/" . $tgl2[1] . "/" . $tgl2[0];

    //     // dd($tgl3);
    //     // $pengajuan = Pengajuan::where('tanggal', 'LIKE', "%{$tgl3}%")->orderBy('jam_m', 'ASC')->get();
    //     $pengajuan = Pengajuan::where('tanggal', $tgl3)->orderBy('jam_m', 'ASC')->get();

    //     $ses_user = session()->get('username');
    //     // if($ses_user!=null){
    //     $pengguna = Pengguna::where('username', $ses_user)->first();

    //     $level = Pengguna::where('username', $ses_user)->value('level');


    //     if ($level == 0) {
    //         $bghariini = "ada";

    //         return view('admin.pengajuan.dashboard', compact('pengguna', 'pengajuan', 'bghariini'));
    //     }
    //     // dd($hari3);
    //     // return redirect('pengajuan');
    //     return view('pengguna.dashboard', compact('pengguna', 'pengajuan'));
    //     // }
    //     // return view('Agenda', compact('pengajuan'));

    // }

    // public function pengajuanbulanini()
    public function pengajuanbulanini(Request $request)
    {
        $dt = Carbon::now()->toDateTimeString();
        $tgl = explode(" ", $dt);
        $tgl2 = explode("-", $tgl[0]);
        $tgl3 = $tgl2[2] . "/" . $tgl2[1] . "/" . $tgl2[0];

        // dd($tgl3);

        $pengajuan = Pengajuan::where('tanggal', 'LIKE', "%{$tgl2[1]}%")->orderBy('tanggal', 'ASC')->orderBy('jam_m', 'ASC')->get();

        $ses_user = session()->get('username');
        if ($ses_user != null) {
            $pengguna = Pengguna::where('username', $ses_user)->first();

            $level = Pengguna::where('username', $ses_user)->value('level');
            // dd($tgl3);
            if ($level == 0) {
                if ($request->ajax()) {
                return DataTables::of($pengajuan)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                               $btn = '
                                <a class="btn btn-info" href="edit/'.$row->id.'">Edit</a>
                                <a class="btn btn-danger" href="delete/'.$row->id.'/bulanini">Delete</a>';
         
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                }
                $bgbulanini = "ada";

                return view('admin.pengajuan.dashboard', compact('pengguna', 'pengajuan', 'bgbulanini'));
            }
            return view('pengguna.dashboard', compact('pengguna', 'pengajuan'));
        }
        return view('agenda', compact('pengajuan'));
    }

    // public function pengajuantahunini()
    public function pengajuantahunini(Request $request)
    {
        $dt = Carbon::now()->toDateTimeString();
        $tgl = explode(" ", $dt);
        $tgl2 = explode("-", $tgl[0]);
        $tgl3 = $tgl2[2] . "/" . $tgl2[1] . "/" . $tgl2[0];

        // dd($tgl3);

        $pengajuan = Pengajuan::where('tanggal', 'LIKE', "%{$tgl2[0]}%")->orderBy('tanggal', 'ASC')->orderBy('jam_m', 'ASC')->get();

        $ses_user = session()->get('username');
        // if($ses_user!=null){
        $pengguna = Pengguna::where('username', $ses_user)->first();

        $level = Pengguna::where('username', $ses_user)->value('level');
        // dd($tgl3);
        if ($level == 0) {
            if ($request->ajax()) {
                return DataTables::of($pengajuan)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                               $btn = '
                                <a class="btn btn-info" href="edit/'.$row->id.'">Edit</a>
                                <a class="btn btn-danger" href="delete/'.$row->id.'/tahunini">Delete</a>';
         
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
            $bgtahunini = "ada";

            return view('admin.pengajuan.dashboard', compact('pengguna', 'pengajuan', 'bgtahunini'));
        }
        return view('pengguna.dashboard', compact('pengguna', 'pengajuan'));
        // }
        // return view('Agenda', compact('pengajuan'));

    }

    public function cektempat(Request $request)
    {
        // dd($request->all());
        // $pengajuan = new Pengajuan;

        $tgl = explode(" ", $request->tanggal);
        $tgl2 = explode("-", $tgl[0]);
        $tgl3 = $tgl2[2] . "/" . $tgl2[1] . "/" . $tgl2[0];

        $c_m = Carbon::parse($request->tanggal . $request->jam_m)->toDateTimeString();
        $c_s = Carbon::parse($request->tanggal . $request->jam_s)->toDateTimeString();

        // $pengajuan = Pengajuan::where('tanggal', $tgl3)
        // ->get(['tempat', 'jam_m', 'jam_s']);
        // if($request->id!=null){

        // }
        $pengajuan = Pengajuan::
            //db 15/01/2023 07.00-09.00
            //   15/01/2023 08.00-10.00
            where('tanggal', $tgl3)
            ->where('jam_mulai', '<=', $c_m)
            ->where('jam_selesai', '>=', $c_m)
            //db 15/01/2023 07.00-09.00
            //   15/01/2023 06.00-08.00
            ->orWhere('tanggal', $tgl3)
            ->where('jam_mulai', '<=', $c_s)
            ->where('jam_selesai', '>=', $c_s)
            //db 15/01/2023 07.00-09.00
            //   15/01/2023 08.00-08.30
            ->orWhere('tanggal', $tgl3)
            ->where('jam_mulai', '<=', $c_m)
            ->where('jam_selesai', '>=', $c_s)
            //db 15/01/2023 07.00-09.00
            //   15/01/2023 06.00-10.30
            ->orWhere('tanggal', $tgl3)
            ->where('jam_mulai', '>=', $c_m)
            ->where('jam_selesai', '<=', $c_s)
            // ->get(['tempat', 'jam_m', 'jam_s', 'acara', 'id']);
            ->get(['tempat', 'jam_m', 'jam_s', 'id']);

        return response()->json($pengajuan);
    }

    public function daftarsemua(Request $request)
    {
        // username sekarang untuk sidebar
        $ses_user = session()->get('username');

        // hilangkan sesion cek jam pada create
        // session()->forget('cek_jam');

        $pengguna = Pengguna::where('username', $ses_user)->first();
        // $pengajuan = Pengajuan::all();
        // dd($pengguna->id);

        // tanggal jam sekarang
        $dt = Carbon::now()->toDateTimeString();
        // tahun-bulan-hari jam:menit:detik
        // 2023-01-15 15:03:30
        $tgl = explode(" ", $dt);
        // [0]2023-01-15 [1]15:03:30
        $tgl2 = explode("-", $tgl[0]);
        // [0]2023 [1]01 [2]15
        $tgl3 = $tgl2[2] . "/" . $tgl2[1] . "/" . $tgl2[0];
        // 15/01/2023

        // dd($tgl3);
        $pengajuan = Pengajuan::orderBy('jam_m', 'ASC')->get();
        if ($request->ajax()) {
            return DataTables::of($pengajuan)
                    ->addIndexColumn()
                    ->make(true);
        }
        $bgsemua = "ada";

        return view('pengguna.pengajuan.daftarSemua', compact('pengajuan', 'pengguna', 'bgsemua'));
    }

    public function daftarsemuahariini(Request $request)
    {
        // username sekarang untuk sidebar
        $ses_user = session()->get('username');

        // hilangkan sesion cek jam pada create
        // session()->forget('cek_jam');

        $pengguna = Pengguna::where('username', $ses_user)->first();
        // $pengajuan = Pengajuan::all();
        // dd($pengguna->id);

        // tanggal jam sekarang
        $dt = Carbon::now()->toDateTimeString();
        // tahun-bulan-hari jam:menit:detik
        // 2023-01-15 15:03:30
        $tgl = explode(" ", $dt);
        // [0]2023-01-15 [1]15:03:30
        $tgl2 = explode("-", $tgl[0]);
        // [0]2023 [1]01 [2]15
        $tgl3 = $tgl2[2] . "/" . $tgl2[1] . "/" . $tgl2[0];
        // 15/01/2023

        // dd($tgl3);
        $pengajuan = Pengajuan::where('tanggal', $tgl3)
            ->orderBy('jam_m', 'ASC')->get();
        // dd($pengajuan);
        
        if ($request->ajax()) {
            return DataTables::of($pengajuan)
                    ->addIndexColumn()
                    ->make(true);
        }
        $bghariini = "ada";

        return view('pengguna.pengajuan.daftarSemua', compact('pengajuan', 'pengguna', 'bghariini'));
    }

    public function daftarsemuabulanini(Request $request)
    {
        // username sekarang untuk sidebar
        $ses_user = session()->get('username');

        // hilangkan sesion cek jam pada create
        // session()->forget('cek_jam');

        $pengguna = Pengguna::where('username', $ses_user)->first();

        // tanggal jam sekarang
        $dt = Carbon::now()->toDateTimeString();
        // tahun-bulan-hari jam:menit:detik
        // 2023-01-15 15:03:30
        $tgl = explode(" ", $dt);
        // [0]2023-01-15 [1]15:03:30
        $tgl2 = explode("-", $tgl[0]);
        // [0]2023 [1]01 [2]15
        $tgl3 = $tgl2[2] . "/" . $tgl2[1] . "/" . $tgl2[0];
        // 15/01/2023

        // dd($tgl3);

        $pengajuan = Pengajuan::where('tanggal', 'LIKE', "%{$tgl2[1]}%")
            ->orderBy('tanggal', 'ASC')
            ->orderBy('jam_m', 'ASC')->get();

        // dd($pengajuan);
        // $pengajuan = Pengajuan::where('id', $pengguna->id)
        //         ->where('tanggal', $tgl3)
        //         ->orderBy('jam_m', 'ASC')->get();
        if ($request->ajax()) {
            return DataTables::of($pengajuan)
                    ->addIndexColumn()
                    ->make(true);
        }
        $bgbulanini = "ada";

        return view('pengguna.pengajuan.daftarSemua', compact('pengajuan', 'pengguna', 'bgbulanini'));
    }

    public function daftarsemuatahunini(Request $request)
    {
        // username sekarang untuk sidebar
        $ses_user = session()->get('username');

        // hilangkan sesion cek jam pada create
        // session()->forget('cek_jam');

        $pengguna = Pengguna::where('username', $ses_user)->first();
        // $pengajuan = Pengajuan::all();
        // dd($pengguna->id);
        // dd($pengguna->id);

        // tanggal jam sekarang
        $dt = Carbon::now()->toDateTimeString();
        // tahun-bulan-hari jam:menit:detik
        // 2023-01-15 15:03:30
        $tgl = explode(" ", $dt);
        // [0]2023-01-15 [1]15:03:30
        $tgl2 = explode("-", $tgl[0]);
        // [0]2023 [1]01 [2]15
        $tgl3 = $tgl2[2] . "/" . $tgl2[1] . "/" . $tgl2[0];
        // 15/01/2023

        // dd($tgl3);

        $pengajuan = Pengajuan::where('tanggal', 'LIKE', "%{$tgl2[0]}%")
            ->orderBy('tanggal', 'ASC')
            ->orderBy('jam_m', 'ASC')->get();

        // dd($pengajuan);
        // $pengajuan = Pengajuan::where('id', $pengguna->id)
        //         ->where('tanggal', $tgl3)
        //         ->orderBy('jam_m', 'ASC')->get();
        if ($request->ajax()) {
            return DataTables::of($pengajuan)
                    ->addIndexColumn()
                    ->make(true);
        }
        $bgtahunini = "ada";

        return view('pengguna.pengajuan.daftarSemua', compact('pengajuan', 'pengguna', 'bgtahunini'));
    }


    // public function daftarsayasemua()
    public function daftarsayasemua(Request $request)
    {
        // username sekarang untuk sidebar
        $ses_user = session()->get('username');

        // hilangkan sesion cek jam pada create
        // session()->forget('cek_jam');

        $pengguna = Pengguna::where('username', $ses_user)->first();

        if (!empty($pengguna->seksi))
            $pengajuan = Pengajuan::where('pemesan', $pengguna->username)
                ->orderBy('jam_m', 'ASC')->get();
        else {
            $pengajuan = Pengajuan::where('bidang', session()->get('bidang'))
                ->orderBy('jam_m', 'ASC')->get();
        }
        $bgsemua = "ada";
        if ($request->ajax()) {
            return DataTables::of($pengajuan)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '
                            <a class="btn btn-info" href="edit/'.$row->id.'">Edit</a>';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('pengguna.pengajuan.daftarSaya', compact('pengajuan', 'pengguna', 'bgsemua'));
    }

    public function daftarsayahariini(Request $request)
    {
        // username sekarang untuk sidebar
        $ses_user = session()->get('username');

        // hilangkan sesion cek jam pada create
        // session()->forget('cek_jam');

        $pengguna = Pengguna::where('username', $ses_user)->first();
        // $pengajuan = Pengajuan::all();
        // dd($pengguna->id);

        // tanggal jam sekarang
        $dt = Carbon::now()->toDateTimeString();
        // tahun-bulan-hari jam:menit:detik
        // 2023-01-15 15:03:30
        $tgl = explode(" ", $dt);
        // [0]2023-01-15 [1]15:03:30
        $tgl2 = explode("-", $tgl[0]);
        // [0]2023 [1]01 [2]15
        $tgl3 = $tgl2[2] . "/" . $tgl2[1] . "/" . $tgl2[0];
        // 15/01/2023

        // dd($tgl3);
        $pengajuan = Pengajuan::where('pemesan', $pengguna->username)
            ->where('tanggal', $tgl3)
            ->orderBy('jam_m', 'ASC')->get();
        if (!empty($pengguna->seksi))
            $pengajuan = Pengajuan::where('pemesan', $pengguna->username)
                ->where('tanggal', $tgl3)
                ->orderBy('jam_m', 'ASC')->get();
        else {
            $pengajuan = Pengajuan::where('bidang', session()->get('bidang'))
                ->where('tanggal', $tgl3)
                ->orderBy('jam_m', 'ASC')->get();
        }
        if ($request->ajax()) {
            return DataTables::of($pengajuan)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '
                            <a class="btn btn-info" href="edit/'.$row->id.'">Edit</a>';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        $bghariini = "ada";
        return view('pengguna.pengajuan.daftarSaya', compact('pengajuan', 'pengguna', 'bghariini'));
    }

    public function daftarsayabulanini(Request $request)
    {
        // username sekarang untuk sidebar
        $ses_user = session()->get('username');

        // hilangkan sesion cek jam pada create
        // session()->forget('cek_jam');

        $pengguna = Pengguna::where('username', $ses_user)->first();
        // $pengajuan = Pengajuan::all();
        // dd($pengguna->id);
        // dd($pengguna->id);

        // tanggal jam sekarang
        $dt = Carbon::now()->toDateTimeString();
        // tahun-bulan-hari jam:menit:detik
        // 2023-01-15 15:03:30
        $tgl = explode(" ", $dt);
        // [0]2023-01-15 [1]15:03:30
        $tgl2 = explode("-", $tgl[0]);
        // [0]2023 [1]01 [2]15
        $tgl3 = $tgl2[2] . "/" . $tgl2[1] . "/" . $tgl2[0];
        // 15/01/2023

        // dd($tgl3);
        if (!empty($pengguna->seksi))
            $pengajuan = Pengajuan::where('pemesan', $pengguna->username)
                ->where('tanggal', 'LIKE', "%{$tgl2[1]}%")
                ->orderBy('tanggal', 'ASC')
                ->orderBy('jam_m', 'ASC')->get();
        else {
            $pengajuan = Pengajuan::where('bidang', session()->get('bidang'))
                ->where('tanggal', 'LIKE', "%{$tgl2[1]}%")
                ->orderBy('tanggal', 'ASC')
                ->orderBy('jam_m', 'ASC')->get();
        }
        if ($request->ajax()) {
            return DataTables::of($pengajuan)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '
                            <a class="btn btn-info" href="edit/'.$row->id.'">Edit</a>';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        // dd($pengajuan);
        // $pengajuan = Pengajuan::where('id', $pengguna->id)
        //         ->where('tanggal', $tgl3)
        //         ->orderBy('jam_m', 'ASC')->get();

        $bgbulanini = "ada";

        return view('pengguna.pengajuan.daftarSaya', compact('pengajuan', 'pengguna', 'bgbulanini'));
    }

    public function daftarsayatahunini(Request $request)
    {
        // username sekarang untuk sidebar
        $ses_user = session()->get('username');

        // hilangkan sesion cek jam pada create
        // session()->forget('cek_jam');

        $pengguna = Pengguna::where('username', $ses_user)->first();
        // $pengajuan = Pengajuan::all();
        // dd($pengguna->id);
        // dd($pengguna->id);

        // tanggal jam sekarang
        $dt = Carbon::now()->toDateTimeString();
        // tahun-bulan-hari jam:menit:detik
        // 2023-01-15 15:03:30
        $tgl = explode(" ", $dt);
        // [0]2023-01-15 [1]15:03:30
        $tgl2 = explode("-", $tgl[0]);
        // [0]2023 [1]01 [2]15
        $tgl3 = $tgl2[2] . "/" . $tgl2[1] . "/" . $tgl2[0];
        // 15/01/2023

        // dd($tgl3);

        if (!empty($pengguna->seksi))
            $pengajuan = Pengajuan::where('pemesan', $pengguna->username)
                ->where('tanggal', 'LIKE', "%{$tgl2[0]}%")
                ->orderBy('tanggal', 'ASC')
                ->orderBy('jam_m', 'ASC')->get();
        else {
            $pengajuan = Pengajuan::where('bidang', session()->get('bidang'))
                ->where('tanggal', 'LIKE', "%{$tgl2[0]}%")
                ->orderBy('tanggal', 'ASC')
                ->orderBy('jam_m', 'ASC')->get();
        }
        if ($request->ajax()) {
            return DataTables::of($pengajuan)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '
                            <a class="btn btn-info" href="edit/'.$row->id.'">Edit</a>';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        // dd($pengajuan);
        // $pengajuan = Pengajuan::where('id', $pengguna->id)
        //         ->where('tanggal', $tgl3)
        //         ->orderBy('jam_m', 'ASC')->get();
        $bgtahunini = "ada";

        return view('pengguna.pengajuan.daftarSaya', compact('pengajuan', 'pengguna', 'bgtahunini'));
    }

    public function daftarsayaedit($id)
    {
        $ses_user = session()->get('username');
        // $ses_e_jam=session()->get('cek_e_jam');
        $pengguna = Pengguna::where('username', $ses_user)->first();

        $pengajuan = Pengajuan::findOrFail($id);
        // dd($pengajuan);
        $tanggal = $pengajuan->tanggal;
        $tgl = explode("/", $tanggal);
        $tgl2 = $tgl[2] . "-" . $tgl[1] . "-" . $tgl[0];
        // dd($tgl2);
        $bidang = Bidang::all();
        if (!empty($pengguna->seksi))
            $seksi = Seksi::where('kode_seksi', '=', session()->get('seksi'))->get();
        else {
            $seksi = Seksi::where('kode_bidang', '=', session()->get('bidang'))->get();
        }

        return view('pengguna.pengajuan.edit', compact('pengguna', 'pengajuan', 'tgl2', 'tanggal', 'bidang', 'seksi'));
    }

    public function daftarsayaupdate(Request $request, $id)
    {
        // dd($request->all());
        $pengajuan = Pengajuan::findOrFail($id);
        $tgl = explode("-", $request->tanggal);
        $tgl2 = $tgl[2] . "/" . $tgl[1] . "/" . $tgl[0];
        $jam = $request->jam_mulai . "-" . $request->jam_selesai;

        $c_m = Carbon::parse($request->tanggal . $request->jam_mulai)->toDateTimeString();
        $c_s = Carbon::parse($request->tanggal . $request->jam_selesai)->toDateTimeString();

        //cek array tempat
        //[0] Aula A [1] Aula B [2] Aula C
        // if($request->tempat==null){
        //     $tempat = $pengajuan->tempat;
        //     // dd($tempat);
        // }
        if (sizeof($request->tempat) == 3) {
            //buang kata Aula
            $aula2 = str_replace("Aula ", "", $request->tempat[1]);
            $aula3 = str_replace("Aula ", "", $request->tempat[2]);
            // $tempat=$request->tempat[0].$aula2.$aula3;
            $tempat = $request->tempat[0] . " " . $aula2 . $aula3;
        }
        if (sizeof($request->tempat) == 2) {
            // dd($request->tempat);
            $aula2 = str_replace("Aula ", "", $request->tempat[1]);

            // $tempat=$request->tempat[0].$aula2;
            $tempat = $request->tempat[0] . " " . $aula2;
        }
        if (sizeof($request->tempat) == 1) {
            $tempat = $request->tempat[0];
        }

        if ($request->keterangan == null) {
            $ket = "";
        } else {
            $ket = $request->keterangan;
        }

        $ar = ([
            'acara' => $request->acara,
            'tempat' => $tempat,
            'tanggal' => $tgl2,
            'jam_m' => $request->jam_mulai,
            'jam_s' => $request->jam_selesai,
            'jam_mulai' => $c_m,
            'jam_selesai' => $c_s,
            'bidang' => $request->bidang,
            'seksi' => $request->seksi,
            'pemesan' => $request->pemesan,
            'keterangan' => $ket
        ]);
        // $pengajuan->update($request->all());
        $pengajuan->update($ar);

        return redirect('pengajuan/daftarsaya/hariini');
    }
}