@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>DAFTAR BUKU PERPUSTAKAAN</h2>
            </div>

        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

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

    <table class="table table-bordered" id="example">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Buku</th>
                <th>Judul Buku</th>
                <th>Kategori Buku</th>
                <th>Nama Penulis</th>
                <th>Nama Penerbit</th>
                <th>Nomor Rak</th>
                <th>Tahun Terbit</th>
                <th>Jumlah</th>
                <th width="200px">Gambar</th>
                <th width="150px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bukus as $Buku)
                <tr>
                    <td>{{ $Buku->id_buku }}</td>
                    <td>{{ $Buku->kode_buku }}</td>
                    <td>{{ $Buku->judul_buku }}</td>
                    <td>{{ $Buku->kategori_buku }}</td>
                    <td>{{ $Buku->nama_penulis }}</td>
                    <td>{{ $Buku->nama_penerbit }}</td>
                    <td>{{ $Buku->no_rak }}</td>
                    <td>{{ $Buku->tahun }}</td>
                    <td>{{ $Buku->jumlah }}</td>
                    <td><img src="{{ asset('storage/' . $Buku->gambar) }}" width="100px;" height="100px;" alt=""></td>
                    <td>
                        <a class="btn btn-info" href="/anggota/buku/{{ $Buku->id_buku }}"> <i class="fas fa-eye"></i>
                            Lihat</a>
                        <a class="btn btn-success" href="" data-toggle="modal" id="smallButton" data-target="#smallModal"
                            data-attr="/anggota/modal/pinjam/{{ $Buku->id_buku }}" title="Pinjam Buku">
                            <i class="fas fa-book"></i> Pinjam
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        // display a modal (small modal)
        $(document).on('click', '#smallButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
    </script>
    <script>
        $(function() {
            $('#example').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
