<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laporan = Peminjaman::join('anggotas', 'peminjaman.anggota_id', '=', 'anggotas.Nim')->join('bukus', 'peminjaman.buku_id', '=', 'bukus.id_buku')
            ->join('users', 'anggotas.user_id', '=', 'users.id')->get(['peminjaman.*', 'anggotas.*', 'users.name', 'bukus.judul_buku']);
        return view('admin.laporan.index', compact('laporan'));
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
        //
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

    public function cetak_pdf(){
        $laporan = Peminjaman::with('buku')->join('anggotas', 'peminjaman.anggota_id', '=', 'anggotas.Nim')
            ->join('users', 'anggotas.user_id', '=', 'users.id')
            ->get(['peminjaman.*', 'anggotas.*', 'users.name']);

        if (Auth::user()->role == 'admin') {
            $pdf = PDF::loadview('admin.laporan.laporan_pdf', compact('laporan'));
            return $pdf->stream();
        } else {
            $pdf = PDF::loadview('petugas.laporan.laporan_pdf', compact('laporan'));
            return $pdf->stream();
        }
    }
}
