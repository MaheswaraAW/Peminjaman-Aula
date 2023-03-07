<?php

namespace App\Http\Controllers;

use App\Seksi;
use App\Bidang;
use App\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
// use Yajra\DataTables\Datatables;
// use Yajra\DataTables\Services\DataTable;
use App\DataTables\PenggunaDataTable;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // public function index(PenggunaDataTable $dataTable)
    public function index(Request $request)
    {
        session()->forget('nama');
        $ses_user = session()->get('username');
        $pengguna = Pengguna::with(['ref_bidang', 'ref_seksi'])->where('username', $ses_user)->first();
        $penggunaall = Pengguna::with(['ref_bidang', 'ref_seksi'])->get();
        $level = Pengguna::with(['ref_bidang', 'ref_seksi'])->where('username', $ses_user)->value('level');

        // $datatb=$dt->render();
        // dd($dt->render('admin.user.index'));
        // dd($level);
        // dd($dt);
        // print_r($dataTable);
        // die();
        if ($level == 0) {
            if ($request->ajax()) {
            // $data = Pengguna::latest()->get();
            $data = Pengguna::with(['ref_bidang', 'ref_seksi'])->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '
                            <a class="btn btn-info" href="user/edit/'.$row->id.'">Edit</a>
                            <a class="btn btn-danger" href="user/delete/'.$row->id.'">Delete</a>
                            <a class="btn btn-warning" href="user/reset/'.$row->id.'">Reset</a>';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            // return $dataTable->render('admin.user.index', compact('pengguna', 'penggunaall'));
            // return view('admin.user.index', compact('pengguna', 'penggunaall','dataTable'));
            return view('admin.user.index', compact('pengguna', 'penggunaall'));
        }
        // dd($pengguna->username);

        return view('pengguna.user.index', compact('pengguna'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ses_user = session()->get('username');
        $ses_nama = session()->get('nama');
        $pengguna = Pengguna::where('username', $ses_user)->first();
        $bidang = Bidang::all();
        if (!empty($pengguna->seksi))
            $seksi = Seksi::where('kode_seksi', '=', session()->get('seksi'))->get();
        else {
            $seksi = Seksi::where('kode_bidang', '=', session()->get('bidang'))->get();
        }
        return view('admin.user.create', compact('pengguna', 'ses_nama', 'pengguna', 'bidang'));
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
        $pass_crypt = Hash::make($request->password);

        if ($pengguna != null) {
            $nama = $request->username;
            // dd($nama);
            session()->put('nama', $nama);
            return redirect('user/create');
        } else {
            Pengguna::create([
                'username' => $request->username,
                'nama' => $request->nama,
                'password' => $pass_crypt,
                'level' => $request->level,
                'bidang' => $request->bidang,
                'seksi' => $request->seksi,
            ]);

            return redirect('user')->with('success', 'Tambah Berhasil');;
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
        $ses_user = session()->get('username');
        $pengguna = Pengguna::where('username', $ses_user)->first();

        $penggunaid = Pengguna::findOrFail($id);
        $bidang = Bidang::all();
        $sseksi = Seksi::all();
        if (!empty($pengguna->seksi))
            $seksi = Seksi::where('kode_seksi', '=', session()->get('seksi'))->get();
        else {
            $seksi = Seksi::where('kode_bidang', '=', session()->get('bidang'))->get();
        }
        // dd($sseksi);

        return view('admin.user.edit', compact('pengguna', 'penggunaid', 'seksi', 'bidang', 'sseksi'));
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
        //sidebar
        //admin
        $ses_user = session()->get('username');
        $pengguna = Pengguna::where('username', $ses_user)->first();
        // dd($request->all());

        //user
        $penggunaid = Pengguna::findOrFail($id);

        //user
        $cek_username = Pengguna::where('username', $request->username)->first();
        // $level = Pengguna::where('username', $request->username)->value('level');
        $level = Pengguna::where('username', $ses_user)->value('level');
        // dd($request->username);
        // dd($cek_username->username);
        // dd($penggunaid->username);
        // dd($ses_user);

        //ada
        if ($cek_username != null) {
            // dd("ada");
            if ($penggunaid->username == $request->username) {
                // dd("username tidak edit");

                if ($request->passwordbaru != null) {
                    // dd("ada pass baru");
                    $pass_crypt = Hash::make($request->passwordbaru);
                    $ar = ([
                        'nama' => $request->nama,
                        'username' => $request->username,
                        'password' => $pass_crypt,
                        // 'password'=> $pass_crypt,
                        'level' => $request->level,
                    ]);

                    $penggunaid->update($ar);

                    // $level = Pengguna::where('username', $ses_user)->value('level');

                    if ($level == 1) {
                        echo "<script>alert('Berhasil Ubah Password. Silahkan Login Kembali');window.location.href='../../login';</script>";

                        // return redirect('login');
                    } else {
                        return redirect('user')->with('success', 'Update Berhasil');;
                    }
                }
                //tidak isi pass baru
                else {
                    // dd("ada pass lama");
                    $ar = ([
                        'nama' => $request->nama,
                        'username' => $request->username,
                        'password' => $request->password,
                        // 'password'=> $pass_crypt,
                        'level' => $request->level,
                    ]);

                    // $level = Pengguna::where('username', $request->username)->value('level');

                    $penggunaid->update($ar);
                    // if($level==1){
                    //     echo "<script>alert('Berhasil Ubah Password');window.location.href='login';</script>";
                    // }

                    return redirect('user')->with('success', 'Update Berhasil');
                }
            } else {
                // dd("edit username sudah ada beda user");
                $nama = "Username Sudah Ada";

                // $level = Pengguna::where('username', $ses_user)->value('level');

                if ($level == 1) {
                    return view('pengguna.user.index', compact('pengguna', 'nama'))->with('success', 'Update Berhasil');
                } else {
                    return view('admin.user.edit', compact('pengguna', 'penggunaid', 'nama'))->with('success', 'Update Berhasil');
                }
            }
        } else {
            // dd($ses_user);
            // dd("user baru");
            if ($request->passwordbaru != null) {
                // $level = Pengguna::where('username', $ses_user)->value('level');
                // dd("user baru pass baru");
                $pass_crypt = Hash::make($request->passwordbaru);
                $ar = ([
                    'nama' => $request->nama,
                    'username' => $request->username,
                    'password' => $pass_crypt,
                    // 'password'=> $pass_crypt,
                    'level' => $request->level,
                ]);

                $penggunaid->update($ar);

                // $level = Pengguna::where('username', $request->username)->value('level');
                // dd($level);
                if ($level == 1) {
                    echo "<script>alert('Berhasil Ubah Password. Silahkan Login Kembali');window.location.href='../../login';</script>";

                    // return redirect('login');
                } else {
                    return redirect('user')->with('success', 'Update Berhasil');
                }
            } else {
                // $level = Pengguna::where('username', $ses_user)->value('level');
                // dd($request->username);
                // dd($ses_user);
                $ar = ([
                    'nama' => $request->nama,
                    'username' => $request->username,
                    'password' => $request->password,
                    // 'password'=> $pass_crypt,
                    'level' => $request->level,
                ]);

                $penggunaid->update($ar);

                if ($level == 1) {
                    echo "<script>alert('Berhasil Ubah Username. Silahkan Login Kembali');window.location.href='../../login';</script>";

                    // return redirect('login');
                } else {
                    return redirect('user')->with('success', 'Update Berhasil');
                }
            }
        }
        //hanya isi password
        // if($request->username==$penggunaid->username&&
        //     $cek_username!=null&&
        //     $request->username==$cek_username->username){
        //         if($request->passwordbaru!=null){
        //             $pass_crypt=Hash::make($request->passwordbaru);
        //             $ar=([
        //                 'nama' => $request->nama,
        //                 'username' => $request->username,
        //                 'password'=> $pass_crypt,
        //                 // 'password'=> $pass_crypt,
        //                 'level'=> $request->level,
        //             ]);
        //             // dd("baru");
        //             $penggunaid->update($ar);

        //             return redirect('user');
        //         }
        //         //hanya ubah nama
        //         else{

        //             $ar=([
        //                 'nama' => $request->nama,
        //                 'username' => $request->username,
        //                 'password'=> $request->password,
        //                 // 'password'=> $pass_crypt,
        //                 'level'=> $request->level,
        //             ]);
        //             // dd("lama");
        //             // $pengguna->update($request->all());
        //             $penggunaid->update($ar);

        //             return redirect('user');
        //         }
        //     // }

        // }
        // if($request->username!=$penggunaid->username&&
        //     $cek_username!=null&&
        //     $request->username==$cek_username->username){
        //     $nama = 'Username Sudah Digunakan';

        //     // dd($nama);
        //     $level = Pengguna::where('username', $ses_user)->value('level');
        //     // dd($level);
        //     if($level==0){
        //         return view('admin.user.edit', compact('pengguna', 'penggunaid', 'nama'));
        //     }
        //     return view('pengguna.user.index', compact('pengguna', 'nama'));

        // }
        // if($request->username!=$penggunaid->username&&
        //     $cek_username==null){
        //     // dd($cek_username);

        //     if($request->passwordbaru!=null){
        //             $pass_crypt=Hash::make($request->passwordbaru);
        //             $ar=([
        //                 'nama' => $request->nama,
        //                 'username' => $request->username,
        //                 'password'=> $pass_crypt,
        //                 // 'password'=> $pass_crypt,
        //                 'level'=> $request->level,
        //             ]);
        //             // dd("update".$ses_user);
        //             $penggunaid->update($ar);

        //             // dd($);
        //             $level = Pengguna::where('username', $ses_user)->value('level');
        //             // dd($level);
        //             if($level==0){
        //                 session()->put('username', request('username'));
        //             }

        //             return redirect('user');
        //         }
        //         else{

        //             $ar=([
        //                 'nama' => $request->nama,
        //                 'username' => $request->username,
        //                 'password'=> $request->password,
        //                 // 'password'=> $pass_crypt,
        //                 'level'=> $request->level,
        //             ]);
        //             // dd("lama".$ses_user);
        //             // $pengguna->update($request->all());
        //             $penggunaid->update($ar);

        //             $level = Pengguna::where('username', $ses_user)->value('level');
        //             // dd($level);
        //             if($level==0){
        //                 session()->put('username', request('username'));
        //             }

        //             return redirect('user');
        //         }
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

        return redirect('user')->with('success', 'Update Berhasil');
    }

    public function reset($id)
    {
        //sidebar
        $ses_user = session()->get('username');
        $pengguna = Pengguna::where('username', $ses_user)->first();

        $penggunaid = Pengguna::findOrFail($id);
        // dd($penggunaid->username."123");
        $pass_crypt = Hash::make($penggunaid->username . "123");
        $ar = ([
            'password' => $pass_crypt
        ]);

        $penggunaid->update($ar);

        // return view('admin.user.index', compact('pengguna'));
        return redirect('user')->with('success', 'Reset Berhasil');
    }
}