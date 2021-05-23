@extends('layouts.admin')

@section('content')

    <div class="container mt-5">

        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    Edit Buku
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Terdapat kesalahan pada data input Anda<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{ route('buku.update', $bukus->id_buku) }}" id="myForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="id_buku">ID</label>
                            <input type="text" name="id_buku" class="form-control" id="id_buku" value="{{ $bukus->id_buku }}"
                                aria-describedby="id_buku">
                        </div>
                        <div class="form-group">
                            <label for="kode_buku">Kode Buku</label>
                            <input type="text" name="kode_buku" class="form-control" id="kode_buku" value="{{ $bukus->kode_buku }}"
                                aria-describedby="kode_buku">
                        </div>
                        <div class="form-group">
                            <label for="judul_buku">Judul Buku</label>
                            <input type="judul_buku" name="judul_buku" class="form-control" id="judul_buku"
                                value="{{ $bukus->judul_buku }}" aria-describedby="judul_buku">
                        </div>
                        <div class="form-group">
                            <label for="kategori_buku">Kategori Buku</label>
                            <input type="kategori_buku" name="kategori_buku" class="form-control" id="kategori_buku"
                                value="{{ $bukus->kategori_buku }}" aria-describedby="kategori_buku">
                        </div>
                        <div class="form-group">
                            <label for="nama_penulis">Nama Penulis</label>
                            <input type="nama_penulis" name="nama_penulis" class="form-control" id="nama_penulis"
                                value="{{ $bukus->nama_penulis }}" aria-describedby="nama_penulis">
                        </div>
                        <div class="form-group">
                            <label for="nama_penerbit">Nama Penerbit</label>
                            <input type="nama_penerbit" name="nama_penerbit" class="form-control" id="nama_penerbit"
                                value="{{ $bukus->nama_penerbit }}" aria-describedby="nama_penerbit">
                        </div>
                        <div class="form-group">
                            <label for="no_rak">Nomor Rak</label>
                            <input type="no_rak" name="no_rak" class="form-control" id="no_rak"
                                value="{{ $bukus->no_rak }}" aria-describedby="no_rak">
                        </div>
                        <div class="form-group">
                            <label for="tahun">Tahun Terbit</label>
                            <input type="tahun" name="tahun" class="form-control" id="tahun"
                                value="{{ $bukus->tahun}}" aria-describedby="tahun">
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="jumlah" name="jumlah" class="form-control" id="jumlah"
                                value="{{ $bukus->jumlah }}" aria-describedby="jumlah">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection