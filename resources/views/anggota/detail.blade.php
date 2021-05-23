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
                        <li class="list-group-item"><img width="100" height="100" src="{{ asset('storage/' . $anggota->Gambar) }}"></li>
                        <li class="list-group-item"><b>Nim: </b>{{ $anggota->Nim }}</li>
                        <li class="list-group-item"><b>Nama: </b>{{ $anggota->Nama }}</li>
                        <li class="list-group-item"><b>Kelas: </b>{{ $anggota->Kelas}}</li>
                        <li class="list-group-item"><b>Jurusan: </b>{{ $anggota->Jurusan }}</li>
                        <li class="list-group-item"><b>No Handphone: </b>{{ $anggota->No_Hp }}</li>
                        <li class="list-group-item"><b>Email: </b>{{ $anggota->Email }}</li>
                    </ul>
                </div>
                <a class="btn btn-success mt-3" href="{{ route('anggota.index') }}">Kembali</a>

            </div>
        </div>
    </div>
@endsection