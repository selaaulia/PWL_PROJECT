@extends('adminlte::page')

@section('title', 'Home Anggota')

@section('content_header')
    <h1>Home Anggota</h1>
@stop

@section('content')
    <p>Selamat datang di Perpustakaan {{$user->name}}.</p>
@stop

