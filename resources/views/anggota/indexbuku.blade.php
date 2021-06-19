@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>DAFTAR BUKU PERPUSTAKAAN</h2>
            </div>

        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered" id="example">
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
                <th width="200px">Gambar</th>
                <th width="50px">Action</th>
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
                    <td><img src="{{ asset('storage/' . $Buku->gambar) }}" width="100px;" height="100px;" alt=""></td>
                    <td>


                        <a class="btn btn-info" href="/anggota/buku/{{$Buku->id_buku}}">Lihat</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('js')
    <script>
        $(function() {
            $('#example').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });

    </script>
@endsection
