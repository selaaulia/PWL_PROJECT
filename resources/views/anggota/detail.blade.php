@extends('layouts.admin')

@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    Detail Anggota
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><img width="100" height="100"
                                src="{{ asset('storage/' . $anggota->Gambar) }}"></li>
                        <li class="list-group-item"><b>Nim: </b>{{ $anggota->Nim }}</li>
                        <li class="list-group-item"><b>Nama: </b>{{ $anggota->user->name }}</li>
                        <li class="list-group-item"><b>Username: </b>{{ $anggota->user->username }}</li>
                        <li class="list-group-item"><b>Kelas: </b>{{ $anggota->Kelas }}</li>
                        <li class="list-group-item"><b>Jurusan: </b>{{ $anggota->Jurusan }}</li>
                        <li class="list-group-item"><b>No Handphone: </b>{{ $anggota->No_Hp }}</li>
                        <li class="list-group-item"><b>Email: </b>{{ $anggota->user->email }}</li>
                    </ul>
                </div>
                @if (Auth::user()->role == 'admin')
                    <a class="btn btn-success mt-3" href="/admin/anggota">Kembali</a>
                @else
                    <a class="btn btn-success mt-3" href="/petugas/anggota">Kembali</a>
                @endif

            </div>
        </div>
    </div>
@endsection
