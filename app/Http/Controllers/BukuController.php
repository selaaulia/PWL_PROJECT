<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bukus = Buku::paginate(10);
        return view('buku.index', ['bukus' => $bukus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add([
            'kode_buku' => 'BK' . str_pad(Buku::max('id_buku') + 1, 3, '0', STR_PAD_LEFT)
        ]);

        $request->validate([
            'kode_buku' => 'required',
            'judul_buku' => 'required',
            'kategori_buku' => 'required',
            'nama_penulis' => 'required',
            'nama_penerbit' => 'required',
            'no_rak' => 'required',
            'tahun' => 'required',
            'jumlah' => 'required',
            'gambar' => 'required|file|image|mimes:jpeg,png,jpg',
        ]);

        //TODO : Implementasikan Proses Simpan Ke Database
        $bukus = new Buku();
        $bukus->kode_buku = $request->get('kode_buku');
        $bukus->judul_buku = $request->get('judul_buku');
        $bukus->kategori_buku = $request->get('kategori_buku');
        $bukus->nama_penulis = $request->get('nama_penulis');
        $bukus->nama_penerbit = $request->get('nama_penerbit');
        $bukus->no_rak = $request->get('no_rak');
        $bukus->tahun = $request->get('tahun');
        $bukus->jumlah = $request->get('jumlah');

        if ($request->file('gambar')) {
            $image_name = $request->file('gambar')->store('images', 'public');
            $bukus->gambar = $image_name;
        }


        
        $bukus->save();

        if (Auth::user()->role == 'admin') {
            return redirect()->to('/admin/buku')
                ->with('success', 'Buku Berhasil Ditambahkan');
        } else {
            return redirect()->to('/petugas/buku')
                ->with('success', 'Buku Berhasil Ditambahkan');
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
        $bukus = Buku::find($id);
        return view('buku.detail', compact('bukus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bukus = Buku::find($id);
        return view('buku.edit', compact('bukus'));
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
        $request->validate([
            'id_buku' => 'required',
            'kode_buku' => 'required',
            'judul_buku' => 'required',
            'kategori_buku' => 'required',
            'nama_penulis' => 'required',
            'nama_penerbit' => 'required',
            'no_rak' => 'required',
            'tahun' => 'required',
            'jumlah' => 'required',
        ]);
        $bukus = Buku::find($id);

        if ($bukus->gambar && file_exists(storage_path('app/public/' . $bukus->gambar))) {
            Storage::delete('/storage/images/' . $bukus->gambar);
        }

        if ($request->file('gambar') != null) {
            $image_name = $request->file('gambar')->store('images', 'public');
            $bukus->gambar = $image_name;
        }

        $bukus->kode_buku = $request->get('kode_buku');
        $bukus->judul_buku = $request->get('judul_buku');
        $bukus->kategori_buku = $request->get('kategori_buku');
        $bukus->nama_penulis = $request->get('nama_penulis');
        $bukus->nama_penerbit = $request->get('nama_penerbit');
        $bukus->no_rak = $request->get('no_rak');
        $bukus->tahun = $request->get('tahun');
        $bukus->jumlah = $request->get('jumlah');
        $bukus->save();        

        //jika data berhasil diupdate, akan kembali ke halaman utama
        if (Auth::user()->role == 'admin') {
            return redirect()->to('/admin/buku')
                ->with('success', 'Buku Berhasil Diubah');
        } else {
            return redirect()->to('/petugas/buku')
                ->with('success', 'Buku Berhasil Diubah');
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
        Buku::find($id)->delete();

        if (Auth::user()->role == 'admin') {
            return redirect()->to('/admin/buku')
                ->with('success', 'Buku Berhasil Dihapus');
        } else {
            return redirect()->to('/petugas/buku')
                ->with('success', 'Buku Berhasil Dihapus');
        }
    }

    public function search(Request $request)
    {
        $bukus = Buku::where([
            [
                'kode_buku', '!=', null, 'OR', 'judul_buku', '!=', null, 'OR', 'kategori_buku', '!=', null, 'OR', 'tahun', '!=', null,
                'OR', 'nama_penerbit', '!=', null, 'OR', 'nama_penulis', '!=', null
            ],
            [function ($query) use ($request) {
                if (($keyword = $request->keyword)) {
                    $query->orWhere('kode_buku', 'like', "%{$keyword}%")
                        ->orWhere('judul_buku', 'like', "%{$keyword}%")
                        ->orWhere('kategori_buku', 'like', "%{$keyword}%")
                        ->orWhere('tahun', 'like', "%{$keyword}%")
                        ->orWhere('nama_penerbit', 'like', "%{$keyword}%")
                        ->orWhere('nama_penulis', 'like', "%{$keyword}%");
                }
            }]
        ])
            ->orderBy('id_buku')
            ->paginate(5);

        return view('buku.index', compact('bukus'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
