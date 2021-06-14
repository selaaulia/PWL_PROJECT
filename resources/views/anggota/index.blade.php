@extends("layouts.admin")
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>PERPUSTAKAAN POLITEKNIK NEGERI MALANG</h2>
            </div>

            <div class="float-left my-4">
                @if (Auth::user()->role == 'admin')
                    <form action="/admin/anggota/cari/" method="GET">
                    @else
                        <form action="/petugas/anggota/cari/" method="GET">
                @endif

                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Search users...">
                    <button type="submit" class="btn btn-primary">
                        Search
                    </button>
                </div>
                </form>
            </div>

            <div class="float-right my-2">
                @if (Auth::user()->role == 'admin')
                    <a class="btn btn-success" href="/admin/anggota/create"> Input anggota</a>
                @else
                    <a class="btn btn-success" href="/petugas/anggota/create"> Input anggota</a>
                @endif
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nim</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>No Handphone</th>
                <th>Email</th>
                <th>Foto</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paginate as $Anggota)
                <tr>
                    <td>{{ $Anggota->Nim }}</td>
                    <td>{{ $Anggota->user->name }}</td>
                    <td>{{ $Anggota->Kelas }}</td>
                    <td>{{ $Anggota->Jurusan }}</td>
                    <td>{{ $Anggota->No_Hp }}</td>
                    <td>{{ $Anggota->user->email }}</td>
                    <td><img src="{{ asset('storage/' . $Anggota->Gambar) }}" width="100px;" height="100px;" alt=""></td>
                    <td>
                        @if (Auth::user()->role == 'admin')
                            <form action="/admin/anggota/{{ $Anggota->Nim }}" method="POST">

                                <a class="btn btn-info" href="/admin/anggota/{{ $Anggota->Nim }}">Lihat</a>

                                <a class="btn btn-primary" href="/admin/anggota/{{ $Anggota->Nim }}/edit">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                            </form>
                        @else
                            <form action="/petugas/anggota/{{ $Anggota->Nim }}" method="POST">

                                <a class="btn btn-info" href="/petugas/anggota/{{ $Anggota->Nim }}">Lihat</a>

                                <a class="btn btn-primary" href="/petugas/anggota/{{ $Anggota->Nim }}/edit">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                            </form>
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex">
        {{ $paginate->links() }}
    </div>
@endsection
