@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>DAFTAR BUKU PERPUSTAKAAN</h2>
            </div>

            <div class="float-left my-4">
                <form action="/mahasiswa/cari/" method="GET">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Search users...">
                        <button type="submit" class="btn btn-primary">
                            Search
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="float-right my-2">
                <a class="btn btn-success" href="{{ route('buku.create') }}"> Input Buku</a>
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
                        <form action="{{ route('buku.destroy', $Buku->id_buku) }}" method="POST">

                            <a class="btn btn-info" href="{{ route('buku.show', $Buku->id_buku) }}">Lihat</a>

                            <a class="btn btn-primary" href="{{ route('buku.edit', $Buku->id_buku) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex">
    {{ $bukus->links() }}
    </div>
@endsection