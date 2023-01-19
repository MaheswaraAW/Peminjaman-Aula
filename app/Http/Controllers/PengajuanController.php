<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengajuan;
use App\Pengguna;
// use App\Tempat;
// use Carbon\Carbon;
use Carbon\Carbon;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // username sekarang untuk sidebar
        $ses_user=session()->get('username');

        // hilangkan sesion cek jam pada create
        // session()->forget('cek_jam');

        $pengguna = Pengguna::where('username', $ses_user)->first();
        // $pengajuan = Pengajuan::all();
        
        // tanggal jam sekarang
        $dt = Carbon::now()->toDateTimeString();
        // tahun-bulan-hari jam:menit:detik
        // 2023-01-15 15:03:30
        $tgl=explode(" ", $dt);
        // [0]2023-01-15 [1]15:03:30
        $tgl2=explode("-", $tgl[0]);
        // [0]2023 [1]01 [2]15 
        $tgl3=$tgl2[2]."/".$tgl2[1]."/".$tgl2[0];
        // 15/01/2023

        // dd($tgl3);
        $pengajuan = Pengajuan::where('tanggal', $tgl3)->orderBy('jam_m', 'ASC')->get();

        // cek level
        $level = Pengguna::where('username', $ses_user)->value('level');
        // dd($level);
        // if($ses_user!=null){
            if($level==0){
                return view('admin.pengajuan.dashboard', compact('pengajuan', 'pengguna'));
            }
            return view('pengguna.dashboard', compact('pengajuan', 'pengguna'));
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
        $ses_user=session()->get('username');
      
        // username untuk create pemesan
        $pengguna = Pengguna::where('username', $ses_user)->first();
        $level = Pengguna::where('username', $ses_user)->value('level');

        if($level==0){
            return view('admin.pengajuan.create', compact('pengguna'));
        }
        return view('pengguna.pengajuan', compact('pengguna'));
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
        //[0] Aula A [1] Aula B [2] Aula C 
        if(sizeof($request->tempat)==3){
            // dd($request->tempat);
            //buang kata Aula
            $aula2=str_replace("Aula ", "", $request->tempat[1]);
            $aula3=str_replace("Aula ", "", $request->tempat[2]);

            $tempat=$request->tempat[0].$aula2.$aula3;
            // $tempat="Aula ABC";
            // dd($tempat);
        }
        if(sizeof($request->tempat)==2){
            // dd($request->tempat);
            $aula2=str_replace("Aula ", "", $request->tempat[1]);

            $tempat=$request->tempat[0].$aula2;
            // dd($tempat);
        }
        if(sizeof($request->tempat)==1){
            $tempat=$request->tempat[0];
        }
        
        //ubah tanggal
        //bulan-hari-tahun
        //hari/bulan/tahun
        $tgl=explode("-", $request->tanggal);
        //[0]tahun [1]bulan [2]hari
        $tgl2=$tgl[2]."/".$tgl[1]."/".$tgl[0];
        // $jam_mulai=explode(":",$request->jam_mulai);
        // $jam_selesai=explode(":",$request->jam_selesai);
        
        // dd($tgl);
        // $c_m=new \DateTime($request->tanggal.$request->jam_mulai);
        // $c_s=new \DateTime($request->tanggal.$request->jam_selesai);
        $c_m=Carbon::parse($request->tanggal.$request->jam_mulai)->toDateTimeString();
        $c_s=Carbon::parse($request->tanggal.$request->jam_selesai)->toDateTimeString();

        if($request->keterangan==null){
            $ket="";
        }
        else{
            $ket=$request->keterangan;
        }
        // if(sizeof($cek_jam)!=0){
        //     return redirect('pengajuan/create');
        // }
        // else{
            Pengajuan::create([
            'acara' => $request->acara,
            'tempat'=> $tempat,
            'tanggal'=> $tgl2,
            'jam_m'=> $request->jam_mulai,
            'jam_s'=> $request->jam_selesai, 
            'jam_mulai'=> $c_m,
            'jam_selesai'=> $c_s,
            'bidang'=> $request->bidang,
            'seksi'=> $request->seksi, 
            'pemesan'=> $request->pemesan, 
            'keterangan'=> $ket
            ]);

            // $ses_user=session()->get('username');
            // $pengguna = Pengguna::where('username', $ses_user)->first();

            return redirect('pengajuan');
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
    public function edit($id, Request $request)
    {
        //
        $ses_user=session()->get('username');
        // $ses_e_jam=session()->get('cek_e_jam');
        $pengguna = Pengguna::where('username', $ses_user)->first();

        $pengajuan = Pengajuan::findOrFail($id);
        // dd($pengajuan);
        $tanggal=$pengajuan->tanggal;
        $tgl=explode("/", $tanggal);
        $tgl2=$tgl[2]."-".$tgl[1]."-".$tgl[0];
        // dd($tgl2);




        return view('admin.pengajuan.edit', compact('pengguna', 'pengajuan', 'tgl2', 'tanggal'));
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
        $tgl=explode("-", $request->tanggal);
        $tgl2=$tgl[2]."/".$tgl[1]."/".$tgl[0];
        $jam=$request->jam_mulai."-".$request->jam_selesai;

        $c_m=Carbon::parse($request->tanggal.$request->jam_mulai)->toDateTimeString();
        $c_s=Carbon::parse($request->tanggal.$request->jam_selesai)->toDateTimeString();

        //cek array tempat
        //[0] Aula A [1] Aula B [2] Aula C 
        if($request->tempat==null){
            $tempat = $pengajuan->tempat;
            // dd($tempat);
        }
        if(sizeof($request->tempat)==3){
            //buang kata Aula
            $aula2=str_replace("Aula ", "", $request->tempat[1]);
            $aula3=str_replace("Aula ", "", $request->tempat[2]);
            $tempat=$request->tempat[0].$aula2.$aula3;
        }
        if(sizeof($request->tempat)==2){
            // dd($request->tempat);
            $aula2=str_replace("Aula ", "", $request->tempat[1]);

            $tempat=$request->tempat[0].$aula2;
        }
        if(sizeof($request->tempat)==1){
            $tempat=$request->tempat[0];
        }



        if($request->keterangan==null){
            $ket="";
        }
        else{
            $ket=$request->keterangan;
        }

        $ar=([
            'acara' => $request->acara,
            'tempat'=> $tempat,
            'tanggal'=> $tgl2,
            'jam_m'=> $request->jam_mulai,
            'jam_s'=> $request->jam_selesai, 
            'jam_mulai'=> $c_m,
            'jam_selesai'=> $c_s,
            'bidang'=> $request->bidang,
            'seksi'=> $request->seksi, 
            'pemesan'=> $request->pemesan, 
            'keterangan'=> $ket
        ]);
        // $pengajuan->update($request->all());
        $pengajuan->update($ar);

        return redirect('pengajuan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->delete();

        return redirect('pengajuan');
    }

    public function pengajuansemua()
    {
        $pengajuan = Pengajuan::orderBy('tanggal', 'ASC')->orderBy('jam_m', 'ASC')->get();
        
        $ses_user=session()->get('username');
        
        $pengguna = Pengguna::where('username', $ses_user)->first();

        $level = Pengguna::where('username', $ses_user)->value('level');

        if($level==0){
            return view('admin.pengajuan.dashboard', compact('pengguna','pengajuan'));    
        }
        return view('pengguna.dashboard', compact('pengguna','pengajuan'));
        
    }

    public function pengajuanhariini()
    {
        $dt = Carbon::now()->toDateTimeString();
        // dd($dt); //2023-01-05 jam:menit:detik
        $tgl=explode(" ", $dt);
        $tgl2=explode("-", $tgl[0]);
        $tgl3=$tgl2[2]."/".$tgl2[1]."/".$tgl2[0];

        // dd($tgl3);
        // $pengajuan = Pengajuan::where('tanggal', 'LIKE', "%{$tgl3}%")->orderBy('jam_m', 'ASC')->get();
        $pengajuan = Pengajuan::where('tanggal', $tgl3)->orderBy('jam_m', 'ASC')->get();        

        $ses_user=session()->get('username');
        // if($ses_user!=null){
            $pengguna = Pengguna::where('username', $ses_user)->first();

            $level = Pengguna::where('username', $ses_user)->value('level');


            if($level==0){
                return view('admin.pengajuan.dashboard', compact('pengguna','pengajuan'));    
            }
            // dd($hari3);
            // return redirect('pengajuan');
            return view('pengguna.dashboard', compact('pengguna','pengajuan'));
        // }
        // return view('Agenda', compact('pengajuan'));

    }

    public function pengajuanbulanini()
    {
        $dt = Carbon::now()->toDateTimeString();
        $tgl=explode(" ", $dt);
        $tgl2=explode("-", $tgl[0]);
        $tgl3=$tgl2[2]."/".$tgl2[1]."/".$tgl2[0];

        // dd($tgl3);

        $pengajuan = Pengajuan::where('tanggal', 'LIKE', "%{$tgl2[1]}%")->orderBy('tanggal', 'ASC')->orderBy('jam_m', 'ASC')->get();        

        $ses_user=session()->get('username');
        if($ses_user!=null){
            $pengguna = Pengguna::where('username', $ses_user)->first();

            $level = Pengguna::where('username', $ses_user)->value('level');
            // dd($tgl3);
            if($level==0){
                return view('admin.pengajuan.dashboard', compact('pengguna','pengajuan'));    
            }
            return view('pengguna.dashboard', compact('pengguna','pengajuan'));
        }
        return view('agenda', compact('pengajuan'));

    }

    public function pengajuantahunini()
    {
        $dt = Carbon::now()->toDateTimeString();
        $tgl=explode(" ", $dt);
        $tgl2=explode("-", $tgl[0]);
        $tgl3=$tgl2[2]."/".$tgl2[1]."/".$tgl2[0];

        // dd($tgl3);

        $pengajuan = Pengajuan::where('tanggal', 'LIKE', "%{$tgl2[0]}%")->orderBy('tanggal', 'ASC')->orderBy('jam_m', 'ASC')->get();        

        $ses_user=session()->get('username');
        // if($ses_user!=null){
            $pengguna = Pengguna::where('username', $ses_user)->first();

            $level = Pengguna::where('username', $ses_user)->value('level');
            // dd($tgl3);
            if($level==0){
                return view('admin.pengajuan.dashboard', compact('pengguna','pengajuan'));    
            }
            return view('pengguna.dashboard', compact('pengguna','pengajuan'));
        // }
        // return view('Agenda', compact('pengajuan'));

    }

    public function cektempat(Request $request){
        // dd($request->all());
        // $pengajuan = new Pengajuan;

        $tgl=explode(" ", $request->tanggal);
        $tgl2=explode("-", $tgl[0]);
        $tgl3=$tgl2[2]."/".$tgl2[1]."/".$tgl2[0];

        $c_m=Carbon::parse($request->tanggal.$request->jam_m)->toDateTimeString();
        $c_s=Carbon::parse($request->tanggal.$request->jam_s)->toDateTimeString();

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
        ->where('jam_mulai', '<=',$c_s)
        ->where('jam_selesai', '>=', $c_s)
        //db 15/01/2023 07.00-09.00
        //   15/01/2023 08.00-08.30
        ->orWhere('tanggal', $tgl3)
        ->where('jam_mulai', '<=',$c_m)
        ->where('jam_selesai', '>=', $c_s)
        //db 15/01/2023 07.00-09.00
        //   15/01/2023 06.00-10.30
        ->orWhere('tanggal', $tgl3)
        ->where('jam_mulai', '>=',$c_m)
        ->where('jam_selesai', '<=', $c_s)
        ->get(['tempat', 'jam_m', 'jam_s', 'acara']);

        return response()->json($pengajuan);
    }    


}
