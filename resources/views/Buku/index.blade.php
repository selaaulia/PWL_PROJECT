@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>DAFTAR BUKU PERPUSTAKAAN</h2>
            </div>

            <div class="float-left my-4">
                @if (Auth::user()->role == 'admin')
                    <form action="/admin/buku/cari/" method="GET">
                    @else
                        <form action="/petugas/buku/cari/" method="GET">
                @endif
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Search books...">
                        <button type="submit" class="btn btn-primary">
                            Search
                        </button>
                    </div>
                </form>
            </div>

            <div class="float-right my-2">
                @if (Auth::user()->role == 'admin')
                    <a class="btn btn-success" href="/admin/buku/create"> Input Buku</a>
                @else
                    <a class="btn btn-success" href="/petugas/buku/create"> Input Buku</a>
                @endif
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Buku</th>
                <th>Judul Buku</th>
                <th>Kategori Buku</th>
                <th>Nama Penulis</th>
                <th>Nama Penerbit</th>
                <th>Nomor Rak</th>
                <th>Tahun Terbit</th>
                <th>Jumlah</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bukus as $Buku)
                <tr>
                    <td>{{ $Buku->id_buku }}</td>
                    <td>{{ $Buku->kode_buku }}</td>
                    <td>{{ $Buku->judul_buku }}</td>
                    <td>{{ $Buku->kategori_buku }}</td>
                    <td>{{ $Buku->nama_penulis }}</td>
                    <td>{{ $Buku->nama_penerbit }}</td>
                    <td>{{ $Buku->no_rak }}</td>
                    <td>{{ $Buku->tahun }}</td>
                    <td>{{ $Buku->jumlah }}</td>
                    <td>
                        @if (Auth::user()->role == 'admin')
                            <form action="/admin/buku/{{ $Buku->id_buku }}" method="POST">

                                <a class="btn btn-info" href="/admin/buku/{{ $Buku->id_buku }}">Lihat</a>

                                <a class="btn btn-primary" href="/admin/buku/{{ $Buku->id_buku }}/edit">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                            </form>
                        @else
                            <form action="/petugas/buku/{{ $Buku->id_buku }}" method="POST">

                                <a class="btn btn-info" href="/petugas/buku/{{ $Buku->id_buku }}">Lihat</a>

                                <a class="btn btn-primary" href="/petugas/buku/{{ $Buku->id_buku }}/edit">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                            </form>
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex">
        {{ $bukus->links() }}
    </div>
@endsection
