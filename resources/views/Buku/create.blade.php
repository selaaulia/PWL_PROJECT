@extends('layouts.admin')

@section('content')
    <div class="container mt-5">

        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    Tambah Buku
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Terjadi Kesalahan pada input data Buku<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Auth::user()->role == 'admin')
                        <form method="post" action="/admin/buku" id="myForm">
                    @else
                        <form method="post" action="/petugas/buku" id="myForm">
                    @endif

                    @csrf
                    <div class="form-group">
                        <label for="judul_buku">Judul Buku</label>
                        <input type="judul_buku" name="judul_buku" class="form-control" id="judul_buku"
                            aria-describedby="judul_buku">
                    </div>
                    <div class="form-group">
                        <label for="kategori_buku">Kategori Buku</label>
                        <input type="kategori_buku" name="kategori_buku" class="form-control" id="kategori_buku"
                            aria-describedby="kategori_buku">
                    </div>
                    <div class="form-group">
                        <label for="nama_penulis">Nama Penulis</label>
                        <input type="nama_penulis" name="nama_penulis" class="form-control" id="nama_penulis"
                            aria-describedby="nama_penulis">
                    </div>
                    <div class="form-group">
                        <label for="nama_penerbit">Nama Penerbit</label>
                        <input type="nama_penerbit" name="nama_penerbit" class="form-control" id="nama_penerbit"
                            aria-describedby="nama_penerbit">
                    </div>
                    <div class="form-group">
                        <label for="no_rak">Nomor Rak</label>
                        <input type="no_rak" name="no_rak" class="form-control" id="no_rak" aria-describedby="no_rak">
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun Terbit</label>
                        <input type="tahun" name="tahun" class="form-control" id="tahun" aria-describedby="tahun">
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="jumlah" name="jumlah" class="form-control" id="jumlah" aria-describedby="jumlah">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
