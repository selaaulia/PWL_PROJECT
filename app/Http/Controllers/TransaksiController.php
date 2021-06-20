<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use DateTime;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pinjam = Peminjaman::join('anggotas', 'peminjaman.anggota_id', '=', 'anggotas.Nim')
            ->join('users', 'anggotas.user_id', '=', 'users.id')->where('peminjaman.status', '!=', 'konfirmasi')
            ->orderBy('peminjaman.id', 'desc')->distinct()->get(['anggotas.*', 'users.name', 'users.email']);
        return view('petugas.peminjaman.index', compact('pinjam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anggota = Anggota::with('user')->get();
        $buku = Buku::all();
        return view('petugas.peminjaman.create', ['anggota' => $anggota, 'buku' => $buku]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TODO : Implementasikan Proses Simpan Ke Database
        $pinjam = new Peminjaman();
        $pinjam->anggota_id = $request->get('anggota');
        $buku_id = $request->get('judul');
        $pinjam->buku_id = $buku_id;
        $jumlah = $request->get('jumlah');
        $pinjam->jumlah = $jumlah;
        $pinjam->tgl_pinjam = now();
        $pinjam->status = 'dipinjam';
        $pinjam->denda = 0;
        $pinjam->perpanjang = 0;

        $buku = Buku::find($buku_id);
        $request->validate([
            'anggota' => 'required',
            'judul' => 'required',
            'jumlah' => 'required|integer|max:'.$buku->jumlah,
        ]);
        $buku->jumlah -= $jumlah;
        $buku->save();
        $pinjam->save();

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('transaksi.index')->with('success', 'Peminjaman Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pinjam = Peminjaman::join('anggotas', 'peminjaman.anggota_id', '=', 'anggotas.Nim')->join('bukus', 'peminjaman.buku_id', '=', 'bukus.id_buku')
            ->join('users', 'anggotas.user_id', '=', 'users.id')->where('peminjaman.id', '=', $id)
            ->select(['peminjaman.*', 'anggotas.*', 'users.name', 'bukus.judul_buku'])->first();
        return view('petugas.peminjaman.detail', compact('pinjam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pinjam = Peminjaman::join('anggotas', 'peminjaman.anggota_id', '=', 'anggotas.Nim')->join('bukus', 'peminjaman.buku_id', '=', 'bukus.id_buku')
            ->where('peminjaman.anggota_id', '=', $id)
            ->get(['peminjaman.*', 'anggotas.*', 'bukus.judul_buku']);
        $anggota = Anggota::with('user')->where('Nim', $id)->first();
        return view('petugas.peminjaman.edit', compact('pinjam', 'anggota'));
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
        $kembali = Peminjaman::find($id);
        $jumlah = $kembali->jumlah;
        $buku_id = $kembali->buku_id;
        $nim = $kembali->anggota_id;
        $kembali->status = 'kembali';
        $tgl_pinjam = $kembali->tgl_pinjam;
        $tgl_kembali = now();
        $kembali->tgl_kembali = $tgl_kembali;

        // Menghitung lama pinjam
        $tgl1 = new DateTime($tgl_pinjam);
        $tgl2 = new DateTime($tgl_kembali);
        $d = $tgl2->diff($tgl1)->days;
        $kembali->lama_pinjam = $d;

        // Menghitung denda
        $lama_pinjam = $d;
        $perpanjang = $kembali->perpanjang;
        $denda = 0;
        if($perpanjang == 1){
            if($lama_pinjam > 14){
                $lama_pinjam -= 14;
                $denda = $lama_pinjam * 2000;
                $kembali->denda = $denda;
            }
        }
        else {
            if($lama_pinjam > 7){
                $lama_pinjam -= 7;
                $denda = $lama_pinjam * 2000;
                $kembali->denda = $denda;
            }
        }

        $buku = Buku::find($buku_id);
        $buku->jumlah += $jumlah;
        $buku->save();
        $kembali->save();

        if($denda > 0){
            return redirect()->to('/petugas/transaksi/' . $nim . '/edit')->with('success', 'Berhasil Mengembalikan Buku, 
            mendapatkan denda sebesar Rp '. $denda . ' Silahkan langsung membayar denda ke petugas!');
        }
        else {
            return redirect()->to('/petugas/transaksi/' . $nim . '/edit')->with('success', 'Berhasil Mengembalikan Buku, Terima kasih telah mengembalikan tepat waktu');
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
        $peminjaman = Peminjaman::find($id);
        $peminjaman->delete();
        return redirect()->to('/petugas/transaksi/konfirmasi')->with('success', 'Peminjaman Berhasil Dibatalkan');
    }

    public function konfirmasiPeminjaman()
    {
        $pinjam = Peminjaman::join('anggotas', 'peminjaman.anggota_id', '=', 'anggotas.Nim')->join('bukus', 'peminjaman.buku_id', '=', 'bukus.id_buku')
            ->join('users', 'anggotas.user_id', '=', 'users.id')->where('peminjaman.status', '=', 'konfirmasi')
            ->get(['peminjaman.*', 'anggotas.*', 'users.name', 'bukus.judul_buku']);
        return view('petugas.peminjaman.konfirmasi', compact('pinjam'));
    }

    public function konfirmasi($id)
    {
        $pinjam = Peminjaman::find($id);
        $pinjam->status = 'dipinjam';
        $pinjam->save();
        return redirect()->to('/petugas/transaksi/konfirmasi')->with('success', 'Konfirmasi Peminjaman Berhasil!');
    }

    public function perpanjang($id)
    {
        $pinjam = Peminjaman::find($id);
        $nim = $pinjam->anggota_id;
        $pinjam->status = 'perpanjang';
        $pinjam->perpanjang = 1;
        $pinjam->save();
        return redirect()->to('/petugas/transaksi/' . $nim . '/edit')->with('success', 'Perpanjang Peminjaman Berhasil!');
    }

}
