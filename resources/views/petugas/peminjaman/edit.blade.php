@extends('layouts.admin')

@section('title', 'Data Peminjaman')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2><a href="/petugas/transaksi" class="back">
                    <</a> Detail Peminjaman Perpustakaan</h2> <hr>
        </div>
    </div>
    <div class="col-lg-12">
        <h5>
            <b>Nama :</b> {{ $anggota->user->name }} <br>
            <b>NIM :</b> {{ $anggota->Nim }} <br>
            <b>Jurusan :</b> {{ $anggota->Jurusan }} <br><br>
        </h5>
        <hr>
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
            <th>Judul Buku</th>
            <th>Jumlah</th>
            <th>Tanggal Pinjam</th>
            <th>Denda</th>
            <th>Status</th>
            <th width="200px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pinjam as $peminjaman)
        <tr>
            <td>{{ $peminjaman->judul_buku }}</td>
            <td>{{$peminjaman->jumlah}}</td>
            <td>{{ date('d-m-Y', strtotime($peminjaman->tgl_pinjam)) }}</td>
            <td>Rp {{ $peminjaman->denda }}</td>
            <td>{{ $peminjaman->status }}</td>
            <td>
                <a class="btn btn-info" href="/petugas/transaksi/{{  $peminjaman->id }}">
                    <i class="fas fa-eye"></i> Show</a>

                @php
                $tgl1 = new DateTime($peminjaman->tgl_pinjam);
                $tgl2 = new DateTime(now());
                $d = $tgl2->diff($tgl1)->days;
                @endphp
                @if ($peminjaman->status == 'dipinjam')
                    @if ($d <= 7) 
                    <form action="/petugas/transaksi/perpanjang/{{  $peminjaman->id }}" method="post" id="myForm">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-warning"
                        onclick="return confirm('Apakah Anda yakin perpanjang peminjaman ini?')"> <i class="fas fa-edit"></i> Perpanjang</button>
                    </form>
                    @endif
                @endif
                @if ($peminjaman->status != 'kembali')
                <form action="/petugas/transaksi/{{  $peminjaman->id }}" method="post" id="myForm">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success"
                    onclick="return confirm('Apakah Anda yakin mengembalikan buku ini?')"> <i class="fas fa-undo"></i> Kembali</button>
                </form>
                @endif
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