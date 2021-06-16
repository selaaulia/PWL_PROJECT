<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anggota = Anggota::with('user')->get();
        $paginate = Anggota::orderBy('Nim', 'asc')->paginate(5);
        return view('anggota.index', ['anggota'=>$anggota, 'paginate' => $paginate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Hp' => 'required',
            'email' => 'required',
            'Gambar'=> 'required|file|image|mimes:jpeg,png,jpg',
            'username' => 'required', 'string', 'max:20', 'unique:users',
            'password' => 'required', 'string', 'min:8',
        ]);

        if ($request->file('Gambar')) {
            $image_name = $request->file('Gambar')->store('images', 'public');
        }

        $user = new User();
        $user->username = $request->get('username');
        $user->password = Hash::make($request->get('password'));
        $user->name = $request->get('Nama');
        $user->email = $request->get('email');
        $user->role = 'anggota';
        $user->save();
        
        $anggota = new Anggota;
        $anggota->nim = $request->get('Nim');
        $anggota->kelas = $request->get('Kelas');
        $anggota->jurusan = $request->get('Jurusan');
        $anggota->no_hp = $request->get('No_Hp');
        $anggota->gambar = $image_name;
        $anggota->user()->associate($user);
        $anggota->save();

        if (Auth::user()->role == 'admin') {
            return redirect()->to('/admin/anggota')
                ->with('success', 'Anggota Berhasil ditambahkan');
        } else {
            return redirect()->to('/petugas/anggota')
                ->with('success', 'Anggota Berhasil ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        $anggota = Anggota::with('user')->where('nim', $Nim)->first();
        return view('anggota.detail', ['anggota'=>$anggota]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
        $Anggota = Anggota::with('user')->where('nim', $Nim)->first();
        return view('anggota.edit', compact('Anggota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Nim)
    {
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Hp' => 'required',
            'Email' => 'required',
            'username' => 'required', 'string', 'max:20', 'unique:users',
        ]);

        $anggota = Anggota::where('Nim', $Nim)->first();

        if ($anggota->gambar && file_exists(storage_path('app/public/' . $anggota->gambar))) {
            Storage::delete('/storage/images/' . $anggota->gambar);
        }

        if ($request->file('Gambar') != null) {
            $image_name = $request->file('Gambar')->store('images', 'public');
            $anggota->gambar = $image_name;
        }

        $userid = $anggota->user_id;
        $user = User::find($userid);
        $user->username = $request->get('username');
        $user->name = $request->get('Nama');
        $user->email = $request->get('Email');
        $user->role = 'anggota';
        $user->save();

        $anggota->nim = $request->get('Nim');
        $anggota->kelas = $request->get('Kelas');
        $anggota->jurusan = $request->get('Jurusan');
        $anggota->no_hp = $request->get('No_Hp');
        $anggota->user()->associate($user);
        $anggota->save();

        if (Auth::user()->role == 'admin') {
            return redirect()->to('/admin/anggota')
                ->with('success', 'Anggota Berhasil Diupdate');
        } else {
            return redirect()->to('/petugas/anggota')
                ->with('success', 'Anggota Berhasil Diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Nim)
    {
        $anggota = Anggota::find($Nim);
        $user_id = $anggota->user_id;
        $user = User::find($user_id);
        File::delete('images/' . $anggota->gambar);
        $anggota->delete();
        $user->delete();
        return redirect()->route('anggota.index')
            ->with('success', 'anggota Berhasil Dihapus');

    }

    public function search(Request $request)
    {
        $paginate = Anggota::join('users', 'anggotas.user_id', '=', 'users.id')->when($request->keyword, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->keyword}%")
                ->orWhere('Nim', 'like', "%{$request->keyword}%")
                ->orWhere('Kelas', 'like', "%{$request->keyword}%")
                ->orWhere('Jurusan', 'like', "%{$request->keyword}%");
        })->paginate(5);
        $paginate->appends($request->only('keyword'));
        return view('anggota.index', compact('paginate'));
    }

    public function home()
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }

    public function buku()
    {
        $bukus = Buku::all();
        return view('anggota.indexbuku', ['bukus' => $bukus]);
    }

    public function lihatbuku($id)
    {
        $bukus = Buku::find($id);
        return view('anggota.detailbuku', compact('bukus'));
    }
}
