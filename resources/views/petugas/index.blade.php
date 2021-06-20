@extends("layouts.admin")
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>DAFTAR PETUGAS PERPUSTAKAAN</h2>
            </div>

            <div class="float-left my-4">
                @if (Auth::user()->role == 'admin')
                    <form action="/admin/petugas/cari/" method="GET">
                    @else
                        <form action="/petugas/petugas/cari/" method="GET">
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
                    <a class="btn btn-success" href="/admin/petugas/create"> Input Petugas</a>
                @else
                    <a class="btn btn-success" href="/petugas/petugas/create"> Input Petugas</a>
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
                <th>ID</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>No Handphone</th>
                <th>Email</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paginate as $Petugas)
                <tr>
                    <td>{{ $Petugas->id }}</td>
                    <td>{{ $Petugas->user->name }}</td>
                    <td>{{ $Petugas->tgl_lahir}}</td>
                    <td>{{ $Petugas->no_hp }}</td>
                    <td>{{ $Petugas->user->email }}</td>
                    <td>
                        @if (Auth::user()->role == 'admin')
                            <form action="/admin/petugas/{{ $Petugas->id }}" method="POST">

                                <a class="btn btn-info" href="/admin/petugas/{{ $Petugas->id }}">Lihat</a>

                                <a class="btn btn-primary" href="/admin/petugas/{{ $Petugas->id }}/edit">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                            </form>
                        @else
                            <form action="/petugas/petugas/{{ $Petugas->id }}" method="POST">

                                <a class="btn btn-info" href="/petugas/petugas/{{ $Petugas->id }}">Lihat</a>

                                <a class="btn btn-primary" href="/petugas/petugas/{{ $Petugas->id }}/edit">Edit</a>

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
