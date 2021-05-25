@extends("layouts.admin")
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>PERPUSTAKAAN POLITEKNIK NEGERI MALANG</h2>
            </div>

            <div class="float-left my-4">
                <form action="/anggota/cari/" method="GET">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Search users...">
                        <button type="submit" class="btn btn-primary">
                            Search
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="float-right my-2">
                <a class="btn btn-success" href="{{ route('anggota.create') }}"> Input anggota</a>
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
                    <td>{{ $Anggota->Nama }}</td>
                    <td>{{ $Anggota->Kelas}}</td>
                    <td>{{ $Anggota->Jurusan }}</td>
                    <td>{{ $Anggota->No_Hp }}</td>
                    <td>{{ $Anggota->Email }}</td>
                    <td><img src="{{ asset('storage/' . $Anggota->Gambar) }}" width="100px;" height="100px;" alt=""></td>
                    <td>
                        <form action="{{ route('anggota.destroy', $Anggota->Nim) }}" method="POST">

                            <a class="btn btn-info" href="{{ route('anggota.show', $Anggota->Nim) }}">Show</a>

                            <a class="btn btn-primary" href="{{ route('anggota.edit', $Anggota->Nim) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin menghapus data ini?')">Delete</button>

                            {{-- <a class="btn btn-warning" href="/anggota/nilai/{{$Anggota->Nim}}">Nilai</a> --}}
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex">
        {{ $paginate->links() }}
    </div>
@endsection