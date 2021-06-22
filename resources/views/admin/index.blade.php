@extends("layouts.admin")
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>DAFTAR ADMIN PERPUSTAKAAN</h2>
            </div>

            <div class="float-left my-4">
                @if (Auth::user()->role == 'admin')
                    <form action="/admin/admin/cari/" method="GET">
                    @else
                    <form action="/admin/admin/cari/" method="GET">
                @endif
                </form>
            </div>

            <div class="float-right my-2">
                @if (Auth::user()->role == 'admin')
                    <a class="btn btn-success" href="/admin/admin/create"> Input Admin</a>
                @else
                    <a class="btn btn-success" href="/admin/admin/create"> Input Admin</a>
                @endif
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered" id="example">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>No Handphone</th>
                <th>Email</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paginate as $Admin)
                <tr>
                    <td>{{ $Admin->id }}</td>
                    <td>{{ $Admin->user->name }}</td>
                    <td>{{ $Admin->no_hp }}</td>
                    <td>{{ $Admin->user->email }}</td>
                    <td>
                        @if (Auth::user()->role == 'admin')
                            <form action="/admin/admin/{{ $Admin->id }}" method="POST">

                                <a class="btn btn-info" href="/admin/admin/{{ $Admin->id }}">Lihat</a>

                                <a class="btn btn-primary" href="/admin/admin/{{ $Admin->id }}/edit">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                            </form>
                        @else
                            <form action="/admin/admin/{{ $Admin->id }}" method="POST">

                                <a class="btn btn-info" href="/admin/admin/{{ $Admin->id }}">Lihat</a>

                                <a class="btn btn-primary" href="/admin/admin/{{ $Admin->id }}/edit">Edit</a>

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
@endsection
@section('js')
<script>
    $(function () {
          $('#example').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
          });
        });
</script>
@stop
