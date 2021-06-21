@extends('layouts.admin')

@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    Detail Buku
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><img src="{{ asset('storage/' . $bukus->gambar) }}" width="200px;"
                                height="200px;" alt=""></li>
                        <li class="list-group-item"><b>ID: </b>{{ $bukus->id_buku }}</li>
                        <li class="list-group-item"><b>Kode Buku: </b>{{ $bukus->kode_buku }}</li>
                        <li class="list-group-item"><b>Judul Buku: </b>{{ $bukus->judul_buku }}</li>
                        <li class="list-group-item"><b>:Kategori: </b>{{ $bukus->kategori_buku }}</li>
                        <li class="list-group-item"><b>Penulis: </b>{{ $bukus->nama_penulis }}</li>
                        <li class="list-group-item"><b>Penerbit: </b>{{ $bukus->nama_penerbit }}</li>
                        <li class="list-group-item"><b>Nomor Rak: </b>{{ $bukus->no_rak }}</li>
                        <li class="list-group-item"><b>Tahun Terbit: </b>{{ $bukus->tahun }}</li>
                        <li class="list-group-item"><b>Jumlah: </b>{{ $bukus->jumlah }}</li>
                    </ul>
                </div>
                <a class="btn btn-info" href="" data-toggle="modal" id="smallButton" data-target="#smallModal"
                    data-attr="/anggota/modal/pinjam/{{ $bukus->id_buku }}" title="Pinjam Buku">
                    <i class="fas fa-book"></i> Pinjam</a>
                <a class="btn btn-success mt-3" href="/anggota/buku">Kembali</a>
            </div>
        </div>
    </div>
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
@endsection
