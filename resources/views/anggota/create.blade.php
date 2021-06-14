@extends('layouts.admin')

@section('content')
    <div class="container mt-5">

        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    Tambah Anggota Perpustakaan
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
                        <form method="post" action="/admin/anggota" id="myForm" enctype="multipart/form-data">
                        @else
                            <form method="post" action="/petugas/anggota" id="myForm" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="form-group">
                        <label for="Nim">Nim</label>
                        <input type="text" name="Nim" class="form-control" id="Nim" aria-describedby="Nim">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="username" name="username" class="form-control" id="username"
                            aria-describedby="username">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password"
                            aria-describedby="password">
                    </div>
                    <div class="form-group">
                        <label for="Nama">Nama</label>
                        <input type="Nama" name="Nama" class="form-control" id="Nama" aria-describedby="Nama">
                    </div>
                    <div class="form-group">
                        <label for="Kelas">Kelas</label>
                        <input name="Kelas" class="form-control" id="Kelas" aria-describedby="Kelas">
                    </div>
                    <div class="form-group">
                        <label for="Jurusan">Jurusan</label>
                        <input type="Jurusan" name="Jurusan" class="form-control" id="Jurusan" aria-describedby="Jurusan">
                    </div>
                    <div class="form-group">
                        <label for="No_Hp">No_Handphone</label>
                        <input type="No_Hp" name="No_Hp" class="form-control" id="No_Hp" aria-describedby="No_Hp">
                    </div>
                    <label for="Gambar">Gambar: </label>
                    <input type="file" class="form-control" name="Gambar"><br>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button><br>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
