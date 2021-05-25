<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
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
        $anggota = Anggota::all(); // Mengambil semua isi tabel
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
            'Email' => 'required',
            'Gambar'=> 'required|file|image|mimes:jpeg,png,jpg',
        ]);

        if ($request->file('Gambar')) {
            $image_name = $request->file('Gambar')->store('images', 'public');
        }

        $anggota = new Anggota;
        $anggota->nim = $request->get('Nim');
        $anggota->nama = $request->get('Nama');
        $anggota->kelas = $request->get('Kelas');
        $anggota->jurusan = $request->get('Jurusan');
        $anggota->no_hp = $request->get('No_Hp');
        $anggota->email = $request->get('Email');
        $anggota->gambar = $image_name;
        $anggota->save();

        return redirect()->route('anggota.index')
            ->with('success', 'anggota Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        $anggota = Anggota::find($Nim);
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
        $Anggota = Anggota::find($Nim);
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
        ]);

        $anggota = Anggota::where('Nim', $Nim)->first();

        if ($anggota->gambar && file_exists(storage_path('app/public/' . $anggota->gambar))) {
            Storage::delete('/storage/images/' . $anggota->gambar);
        }

        if ($request->file('Gambar') != null) {
            $image_name = $request->file('Gambar')->store('images', 'public');
            $anggota->gambar = $image_name;
        }

        $anggota->nim = $request->get('Nim');
        $anggota->nama = $request->get('Nama');
        $anggota->kelas = $request->get('Kelas');
        $anggota->jurusan = $request->get('Jurusan');
        $anggota->no_hp = $request->get('No_Hp');
        $anggota->email = $request->get('Email');
        $anggota->save();

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota Berhasil Diupdate');
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
        Storage::delete('storage/app/public/' . $anggota->gambar);
        $anggota->delete();
        return redirect()->route('anggota.index')
            ->with('success', 'Anggota Berhasil Dihapus');
    }

    public function search(Request $request)
    {
        $paginate = Anggota::when($request->keyword, function ($query) use ($request) {
            $query->where('Nama', 'like', "%{$request->keyword}%")
                ->orWhere('Nim', 'like', "%{$request->keyword}%")
                ->orWhere('Kelas', 'like', "%{$request->keyword}%")
                ->orWhere('Jurusan', 'like', "%{$request->keyword}%");
        })->paginate(5);
        $paginate->appends($request->only('keyword'));
        return view('anggota.index', compact('paginate'));
    }
}
