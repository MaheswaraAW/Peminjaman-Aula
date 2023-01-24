<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengguna;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->forget('nama');
        $ses_user=session()->get('username');
        $pengguna = Pengguna::where('username', $ses_user)->first();
        $penggunaall = Pengguna::all();
        
        return view('admin.user.index', compact('pengguna', 'penggunaall'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ses_user=session()->get('username');
        $ses_nama=session()->get('nama');
        $pengguna = Pengguna::where('username', $ses_user)->first();

        return view('admin.user.create', compact('pengguna', 'ses_nama'));
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
        $pengguna = Pengguna::where('username', request('username'))->first();
        // dd($pengguna);
        $pass_crypt=Hash::make($request->password);

        if($pengguna!=null){
            $nama=$request->username;
            // dd($nama);
            session()->put('nama', $nama);
            return redirect('user/create');
        }
        else{
            Pengguna::create([
                'username' => $request->username,
                'nama'=> $request->nama,
                'password'=> $pass_crypt,
                'level'=> $request->level,
            ]);

            return redirect('user');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //sidebar
        $ses_user=session()->get('username');
        $pengguna = Pengguna::where('username', $ses_user)->first();

        $penggunaid = Pengguna::findOrFail($id);

        return view('admin.user.edit', compact('pengguna', 'penggunaid'));
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
        //sidebar admin
        $ses_user=session()->get('username');
        $pengguna = Pengguna::where('username', $ses_user)->first();
        // dd($request->all());
        // $pass_crypt=Hash::make($request->password);        

        $penggunaid = Pengguna::findOrFail($id);

        $cek_username=Pengguna::where('username', $request->username)->first();

        // dd($request->username);
        // dd($cek_username->username);
        // dd($penggunaid->username);
        if($request->username==$penggunaid->username&&
            $cek_username!=null&&
            $request->username==$cek_username->username){
                if($request->passwordbaru!=null){
                    $pass_crypt=Hash::make($request->passwordbaru);
                    $ar=([
                        'nama' => $request->nama,
                        'username' => $request->username,
                        'password'=> $pass_crypt,
                        // 'password'=> $pass_crypt,
                        'level'=> $request->level,
                    ]);
                    // dd("baru");
                    $penggunaid->update($ar);

                    return redirect('user');
                }
                else{

                    $ar=([
                        'nama' => $request->nama,
                        'username' => $request->username,
                        'password'=> $request->password,
                        // 'password'=> $pass_crypt,
                        'level'=> $request->level,
                    ]);
                    // dd("lama");
                    // $pengguna->update($request->all());
                    $penggunaid->update($ar);

                    return redirect('user');
                }   
            // }

        }
        if($request->username!=$penggunaid->username&&
            $cek_username!=null&&
            $request->username==$cek_username->username){
            $nama = 'Username Sudah Digunakan';

            // dd($nama);
            return view('admin.user.edit', compact('pengguna', 'penggunaid', 'nama'));
        }
        if($request->username!=$penggunaid->username&&
            $cek_username==null){
            // dd($cek_username);

            if($request->passwordbaru!=null){
                    $pass_crypt=Hash::make($request->passwordbaru);
                    $ar=([
                        'nama' => $request->nama,
                        'username' => $request->username,
                        'password'=> $pass_crypt,
                        // 'password'=> $pass_crypt,
                        'level'=> $request->level,
                    ]);
                    // dd("baru");
                    $penggunaid->update($ar);

                    return redirect('user');
                }
                else{

                    $ar=([
                        'nama' => $request->nama,
                        'username' => $request->username,
                        'password'=> $request->password,
                        // 'password'=> $pass_crypt,
                        'level'=> $request->level,
                    ]);
                    // dd("lama");
                    // $pengguna->update($request->all());
                    $penggunaid->update($ar);

                    return redirect('user');
                }
        }


        // if($cek_username!=null&&$request->vusername==null){
        //     $nama=$request->username;
        //     // dd($nama);
        //     // session()->put('nama', $nama);
        //     return view('admin.user.edit', compact('pengguna', 'penggunaid', 'nama'));
        // }
        // // if($cek_username!=null&&)
        // else{
        //     // dd($request->all());
        //     if($request->passwordbaru!=null){
        //         $pass_crypt=Hash::make($request->passwordbaru);
        //         $ar=([
        //             'nama' => $request->nama,
        //             'username' => $request->username,
        //             'password'=> $pass_crypt,
        //             // 'password'=> $pass_crypt,
        //             'level'=> $request->level,
        //         ]);
        //         // dd("baru");
        //         $penggunaid->update($ar);

        //         return redirect('user');
        //     }
        //     else{

        //         $ar=([
        //             'nama' => $request->nama,
        //             'username' => $request->username,
        //             'password'=> $request->password,
        //             // 'password'=> $pass_crypt,
        //             'level'=> $request->level,
        //         ]);
        //         // dd("lama");
        //         // $pengguna->update($request->all());
        //         $penggunaid->update($ar);

        //         return redirect('user');
        //     }
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $pengguna->delete();

        return redirect('user');
    }
}
