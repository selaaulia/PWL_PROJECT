@extends('layouts.admin')

@section('content')

    <div class="container mt-5">

        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    Edit Anggota
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Auth::user()->role == 'admin')
                        <form method="post" action="/admin/anggota/{{ $Anggota->Nim }}" id="myForm"
                            enctype="multipart/form-data">
                        @else
                            <form method="post" action="/petugas/anggota/{{ $Anggota->Nim }}" id="myForm"
                                enctype="multipart/form-data">
                    @endif
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="Nim">Nim</label>
                        <input type="text" name="Nim" class="form-control" id="Nim" value="{{ $Anggota->Nim }}"
                            aria-describedby="Nim">
                    </div>
                    <div class="form-group">
                        <label for="Nama">Nama</label>
                        <input type="text" name="Nama" class="form-control" id="Nama" value="{{ $Anggota->user->name }}"
                            aria-describedby="Nama">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="username" name="username" class="form-control" id="username"
                            value="{{ $Anggota->user->username }}" aria-describedby="username">
                    </div>
                    <div class="form-group">
                        <label for="Kelas">Kelas</label>
                        <input name="Kelas" class="form-control" id="Kelas" value="{{ $Anggota->Kelas }}"
                            aria-describedby="Nama">
                    </div>
                    <div class="form-group">
                        <label for="Jurusan">Jurusan</label>
                        <input type="Jurusan" name="Jurusan" class="form-control" id="Jurusan"
                            value="{{ $Anggota->Jurusan }}" aria-describedby="Jurusan">
                    </div>
                    <div class="form-group">
                        <label for="No_Hp">No_Hp</label>
                        <input type="No_Hp" name="No_Hp" class="form-control" id="No_Hp" value="{{ $Anggota->No_Hp }}"
                            aria-describedby="No_Hp">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="Email" name="Email" class="form-control" id="Email"
                            value="{{ $Anggota->user->email }}" aria-describedby="Email">
                    </div>
                    <div class="form-group">
                        <label for="Gambar">gambar: </label> <input type="file" class="form-control" name="Gambar"><br>
                        <img width="100" height="100" src="{{ asset('storage/' . $Anggota->Gambar) }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
