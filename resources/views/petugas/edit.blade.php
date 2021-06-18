@extends('layouts.admin')

@section('content')

    <div class="container mt-5">

        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    Edit Petugas
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
                        <form method="post" action="/admin/petugas/{{ $petugas->id }}" id="myForm"
                            enctype="multipart/form-data">
                        @else
                            <form method="post" action="/petugas/petugas/{{ $petugas->id }}" id="myForm"
                                enctype="multipart/form-data">
                    @endif
                    @csrf
                    @method('PUT')
                    <form method="post" action="{{ route('petugas.update', $petugas->id) }}" id="myForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="username" name="username" class="form-control" id="username" aria-describedby="username"
                                value="{{ $petugas->user->username }}">
                        </div>
                        <div class="form-group">
                            <label for="id">Id</label>
                            <input type="text" name="id" class="form-control" id="id" aria-describedby="id"
                                value="{{ $petugas->id }}">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="nama" name="nama" class="form-control" id="nama" aria-describedby="nama"
                                value="{{ $petugas->user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" aria-describedby="tgl_lahir"
                            value="{{\Carbon\Carbon::parse($petugas->tgl_lahir)->toDateString()}}"> 
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Handphone</label>
                            <input type="no_hp" name="no_hp" class="form-control" id="no_hp"
                                aria-describedby="no_hp" value="{{ $petugas->no_hp }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="email"
                                value="{{ $petugas->user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea type="alamat" name="alamat" class="form-control" id="alamat" aria-describedby="alamat"
                                value="{{ $petugas->alamat }}">{{ $petugas->alamat }}</textarea>
                        </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
