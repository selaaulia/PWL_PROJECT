<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        if (Auth::user()->role == 'admin') {
            $user = Admin::with('user')->where('user_id', $id)->first();
        } else if (Auth::user()->role == 'petugas') {
            $user = Petugas::with('user')->where('user_id', $id)->first();
        } else {
            $user = Anggota::with('user')->where('user_id', $id)->first();
        }
        return view('profile', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //melakukan validasi data
        $request->validate([
            'username' => 'required', 'string', 'max:20', 'unique:users',
            'nim' => 'numeric',
            'nama' => 'required',
            'no_hp' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'email' => 'required|email',
        ]);

        //TODO : Implementasikan Proses Simpan Ke Database
        if (Auth::user()->role == 'admin') {
            $admin = Admin::find($id);
            $user_id = $admin->user_id;
            $admin->no_hp = $request->get('no_hp');
            $admin->alamat = $request->get('alamat');
            $user = User::find($user_id);
            $user->role = 'admin';
            $user->username = $request->get('username');
            $user->name = $request->get('nama');
            $user->email = $request->get('email');
            $user->save();
            // fungsi eloquent untuk menambah data dengan relasi belongsTo
            $admin->user()->associate($user);
            $admin->save();
        } else if (Auth::user()->role == 'petugas') {
            $petugas = Petugas::find($id);
            $user_id = $petugas->user_id;
            $petugas->tgl_lahir = $request->get('tgl_lahir');
            $petugas->no_hp = $request->get('no_hp');
            $petugas->alamat = $request->get('alamat');
            $user = User::find($user_id);
            $user->role = 'petugas';
            $user->username = $request->get('username');
            $user->name = $request->get('nama');
            $user->email = $request->get('email');
            $user->save();
            // fungsi eloquent untuk menambah data dengan relasi belongsTo
            $petugas->user()->associate($user);
            $petugas->save();
        } else {
            $anggota = Anggota::find($id);
            if ($anggota->gambar && file_exists(storage_path('app/public/' . $anggota->gambar))) {
                Storage::delete('/storage/images/' . $anggota->gambar);
            }
    
            if ($request->file('Gambar') != null) {
                $image_name = $request->file('Gambar')->store('images', 'public');
                $anggota->gambar = $image_name;
            }
            $user_id = $anggota->user_id;
            $anggota->nim = $request->get('nim');
            $anggota->jurusan = $request->get('jurusan');
            $anggota->kelas = $request->get('kelas');
            $anggota->no_hp = $request->get('no_hp');
            $user = User::find($user_id);
            $user->role = 'anggota';
            $user->username = $request->get('username');
            $user->name = $request->get('nama');
            $user->email = $request->get('email');
            $user->save();
            // fungsi eloquent untuk menambah data dengan relasi belongsTo
            $anggota->user()->associate($user);
            $anggota->save();
        }

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('profile.index')->with('success', 'Berhasil edit profile');

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
}
