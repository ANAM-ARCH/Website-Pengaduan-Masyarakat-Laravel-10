@extends('layouts.appPetugas')

@section('content')
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<body id="page-top">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan</h6>
        </div>
        <tbody>
            <?php $lapors = $lapor->where('jenis', Auth::user()->jenis) ?>
        <div class="card-body">
            @if(session()->has('message'))
            <div class="alert alert-success">
               {{ session()->get('message') }}
           </div>
           @else
           @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Isi</th>
                            <th>Tanggal Pengaduan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @foreach ( $lapors->where('status', 'proses') as $l  )
                        <tr>
                            <td>{{ $l->id_pengaduan }}</td>
                            <td>{{ $l->nik }}</td>
                            <td>{{ $l->nama }}</td>
                            <td>{{ $l->jenis }}</td>
                            <td>{{ $l->isi_laporan }}</td>
                            <td>{{ $l->created_at }}</td>
                            <td><div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail{{ $l->id_pengaduan }}">
                                    Detail
                                  </button>
                            </div></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>

    @foreach ($lapors as $l)
<div class="modal fade" id="detail{{ $l->id_pengaduan }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Detail Laporan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p class="float-right font-italic">{{ $l->jenis }}</p>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                 Detail Pelapor
                </button>
              <div class="collapse" id="collapseExample">
                <div class="card-header">
                    <pre>NIK    : {{ $l->nik }}</pre>
                    <pre>Nama   : {{ $l->nama }}</pre>
                    <pre>Lokasi : {{ $l->lokasi }}</pre>
                  </div>
              </div>
              <div class="card-body text-center">
                  <h5 class="card-title font-weight-bold">{{ $l->judul }}</h5>
                <img class="card-img-top" src="images/{{ $l->foto }}" style="width: 80vh" alt="Card image cap">
                <p class="card-text mt-3">{{ $l->isi_laporan }}</p>
                <form action="{{ route('tanggapan', $l->id_pengaduan) }}" method="post">
                    @csrf
                    <input type="text" name="id_petugas" value="{{ Auth::user()->id_petugas }}" hidden>
                    <input type="text" value="{{ $l->id_pengaduan }}" name="id_pengaduan" hidden>
                    <input type="text" value="selesai" name="status" hidden>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="tanggapan" rows="3"></textarea>
                    <button type="submit" class="btn btn-primary mt-2">Tanggapi</button>
                </form>
              </div>

              <div class="card-footer text-muted">
                {{ $l->created_at }}
              </div>
            </div>
        </div>
        </div>
    </div>
@endforeach

    </body>
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src=" vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
        <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>



@endsection
