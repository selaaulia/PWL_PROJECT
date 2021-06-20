@extends('layouts.admin')

@section('title', 'Konfirmasi Peminjaman')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2>Konfirmasi Peminjaman</h2>
            <hr>
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
            <th>NIM</th>
            <th>Nama</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th width="220px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pinjam as $peminjaman)
        <tr>
            <td>{{ $peminjaman->Nim }}</td>
            <td>{{ $peminjaman->name }}</td>
            <td>{{ $peminjaman->judul_buku }}</td>
            <td>{{ date('d-m-Y', strtotime($peminjaman->tgl_pinjam))}}</td>
            <td>
                <form action="/petugas/transaksi/konfirmasi/{{  $peminjaman->id }}" method="post" id="myForm">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-warning"
                    onclick="return confirm('Apakah Anda yakin konfirmasi peminjaman ini?')"> <i class="fas fa-check-circle"></i> Konfirmasi</button>
                </form>
                <form action="/petugas/transaksi/{{ $peminjaman->id }}" method="post" id="myForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                    onclick="return confirm('Apakah Anda yakin membatalkan peminjaman ini?')"> <i class="fas fa-times-circle"></i> Batal</button>
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
            aaSorting: [[4, 'asc']],
          });
        });
</script>
@stop