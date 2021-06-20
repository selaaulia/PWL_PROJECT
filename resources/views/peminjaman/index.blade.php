@extends('layouts.admin')

@section('title', 'Data Peminjaman')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2>Data Peminjaman Perpustakaan</h2>
            <hr>
        </div>
        <div class="float-right my-2">
            <a class="btn btn-success" href="/admin/peminjaman/create"><i class="fas fa-arrow-circle-down"></i> Input
                Peminjaman</a>
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
            <th>Id</th>
            <th>Anggota</th>
            <th>Judul Buku</th>
            <th>Jumlah</th>
            <th>Tanggal Pinjam</th>
            <th>Status</th>
            <th width="320px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pinjam as $peminjaman)
        <tr>
            <td>{{ $peminjaman->id }}</td>
            <td>{{ $peminjaman->name }}</td>
            <td>{{ $peminjaman->judul_buku }}</td>
            <td>{{$peminjaman->jumlah}}</td>
            <td>{{ date('d-m-Y', strtotime($peminjaman->tgl_pinjam)) }}</td>
            <td>{{ $peminjaman->status }}</td>
            <td>
                <form action="/admin/peminjaman/{{ $peminjaman->id }}" method="POST">

                    <a class="btn btn-info" href="/admin/peminjaman/{{ $peminjaman->id }}"> <i class="fas fa-eye"></i> Lihat</a>

                    <a class="btn btn-primary" href="/admin/peminjaman/{{ $peminjaman->id }}/edit"> <i class="fas fa-pencil-alt"></i> Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"> <i class="fas fa-trash"></i> Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('js')
<script>
    $(function () {
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
@stop