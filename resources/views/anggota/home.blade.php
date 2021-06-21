@extends('layouts.admin')

@section('title', 'Home Anggota')

@section('content_header')
    <h1>Home Anggota</h1>
    <h5>Selamat datang di Perpustakaan {{$user->name}}.</h5>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">Aturan Peminjaman</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-light alert-dismissible" style="margin-top: 20px">
                        <h5><i class="icon fas fa-info"></i> Informasi Aturan Peminjaman</h5>
                        <ol>
                            <li>Waktu Peminjaman maksimal 7 hari</li>
                            <li>Peminjaman dapat diperpanjang maksimal 1 kali (total lama pinjam 14 hari)</li>
                            <li>Jika mengembalikan lebih dari waktu yang ditentukan akan dikenakan denda setiap judul Rp 2.000 / hari</li>
                            <li>Jika telah memilih buku dan klik pinjam, silahkan ke petugas untuk melakukan konfirmasi</li>
                            <li>Jika terlambat mengembalikan buku dan mendapat denda, wajib langsung bayar denda ke petugas saat mengembalikan buku</li>
                        </ol>
                      </div>
                </div>
               <div class="col-lg-5">
               </div>
            </div>
        </div>
    </div>
@stop