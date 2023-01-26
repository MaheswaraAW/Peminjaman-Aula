<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Pengajuan;
use App\Pengguna;
use App\Profile;
use App\Teksberjalan;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ses_user=session()->get('username');
        $pengguna = Pengguna::where('username', $ses_user)->first();
        $pengajuan = Profile::all();
        $level = Pengguna::where('username', $ses_user)->value('level');

        $id = Profile::first()->value('id');
        // dd($id);
        $profile = Profile::findOrFail($id);
        // dd($id_pertama);
        if($level==0){
            // dd($level);
            return view('admin.profile.index', compact('pengguna', 'profile'));
        }
        return view('pengguna.profile', compact('pengguna','profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ses_user=session()->get('username');
        $pengguna = Pengguna::where('username', $ses_user)->first();

        return view('admin.profile.tambah', compact('pengguna','profile'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //simpan profile

        return redirect('profile/edit');
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
    // public function edit($id)
    public function edit()
    {
        // $profile = Profile::findOrFail($id);
        $ses_user=session()->get('username');
        $pengguna = Pengguna::where('username', $ses_user)->first();

        // $profile = Profile::findOrFail($id);

        $profile = Profile::all();

        $teks_berjalan = Teksberjalan::first();
        // dd($profile->teks_berjalan);
        $teks = $teks_berjalan->teks;
        // dd($teks_berjalan->teks);
        // return redirect('profile');


        return view('admin.profile.edit', compact('pengguna','profile', 'teks'));
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
        $profile = Profile::findOrFail($id);
        if($request->file!=null){
            \File::delete(public_path('Video/'.$request->video));
            $profile->delete();
        // dd($video_pertama);
            $file=$request->file('file');
            $ext=$request->file->extension();
        // $file=$request->file;
            $video=time().$request->nama.".".$ext;
            $file->move(public_path('Video'),$video);
        // $rando=;


        // dd($ext, $file);

            Profile::create([
                'nama' => $request->nama,
                'video'=> $video,
                'teks_berjalan' => $request->teks_berjalan      
            ]);
            // $ar=([
            //     'nama' => $request->nama,
            //     'video'=> $video,
            //     'teks_berjalan' => $request->teks_berjalan,       
            // ]);
            // $profile->update($ar);
        // dd($request->all());
            return redirect('profile');
        }
        else{
            $ar=([
                'nama' => $request->nama,
                'video'=> $request->video,
                'teks_berjalan' => $request->teks_berjalan
            ]);
            $profile->update($ar);
        // dd($request->all());
            return redirect('profile');   
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function editvideo($id)
    {
        // $profile = Profile::findOrFail($id);
        $ses_user=session()->get('username');
        $pengguna = Pengguna::where('username', $ses_user)->first();

        $profile = Profile::findOrFail($id);

        // $profile = Profile::all();

        // $teks_berjalan = Teksberjalan::first();
        // dd($profile->teks_berjalan);
        // $teks = $teks_berjalan->teks;
        // dd($teks_berjalan->teks);
        // return redirect('profile');


        return view('admin.profile.editvideo', compact('pengguna','profile'));
    }

    public function updatevideo(Request $request, $id)
    {
        // dd($request->all());
        $profile = Profile::findOrFail($id);
        if($request->file!=null){
            \File::delete(public_path('Video/'.$request->video));
            $profile->delete();
        // dd($video_pertama);
            $file=$request->file('file');
            $ext=$request->file->extension();
        // $file=$request->file;
            $video=time().$request->nama.".".$ext;
            $file->move(public_path('Video'),$video);

            Profile::create([
                'nama' => $request->nama,
                'video'=> $video,      
            ]);

            return redirect('profile/edit');
        }
        else{
            $ar=([
                'nama' => $request->nama,
                'video'=> $request->video,
            ]);
            $profile->update($ar);
        // dd($request->all());
            return redirect('profile/edit');   
        }
    }

    public function simpanvideo(Request $request)
    {
        // dd($request->all());
        $file=$request->file('file');
        $ext=$request->file->extension();
        
        $video=time().$request->nama.".".$ext;
        $file->move(public_path('Video'),$video);
        // dd($video);
    
        Profile::create([
            'nama' => $request->nama,
            'video'=> $video,      
        ]);

        return redirect('profile/edit');
    }
}
