@extends('layouts.appAdmin')

@section('content')
    <!-- Custom styles for this page -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<body id="page-top">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Validasi Laporan</h6>
        </div>
        <tbody>
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
                            <th>Lokasi</th>
                            <th>Isi</th>
                            <th>Tanggal Pengaduan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @foreach ( $lapor->where('status', 0) as $l  )
                        <tr>
                            <td>{{ $l->id_pengaduan }}</td>
                            <td>{{ $l->nik }}</td>
                            <td>{{ $l->nama }}</td>
                            <td>{{ $l->jenis }}</td>
                            <td>{{ $l->lokasi }}</td>
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
    @foreach ($lapor as $l)
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
                <button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Detail Pelapor
                   </button>
                 <div class="collapse" id="collapseExample">
                   <div class="card-header">
                       <pre>NIK    : {{ $l->nik }}</pre>
                       <pre>Nama   : {{ $l->nama }}</pre>
                       <pre>Lokasi : {{ $l->lokasi }}</pre>
                     </div>
                 </div>
                  </div>
                  <div class="card-body text-center">
                      <h5 class="card-title font-weight-bold">{{ $l->judul }}</h5>
                    <img class="card-img-top" src="{{ asset( 'images/' . $l->foto ) }}" style="width: 80vh" alt="Card image cap">
                    <p class="card-text mt-3">{{ $l->isi_laporan }}</p>
                    @if ($l->status == 0)
                    <div class="d-flex mx-2 justify-content-center">
                        <form action="{{ route('ajukan', $l->id_pengaduan) }}" method="post">
                            @csrf
                            <input type="text" value="proses" name="status" hidden>
                            <button type="submit" class="btn btn-primary">Ajukan Laporan</button>
                        </form>
                        <button type="button" class="btn btn-danger ml-2" data-dismiss="modal" data-toggle="modal" data-target="#hapus{{ $l->id_pengaduan }}">
                            Hapus
                          </button>
                    </div>
                    @endif
                  </div>

                  <div class="card-footer text-muted">
                    {{ $l->created_at }}
                  </div>
                </div>
            </div>
            </div>
        </div>
    @endforeach

@foreach ($lapor as $l)
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
                <button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
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
                <img class="card-img-top" src="{{ asset( 'images/' . $l->foto ) }}" style="width: 80vh" alt="Card image cap">
                <p class="card-text mt-3">{{ $l->isi_laporan }}</p>
                @if ($l->status == 0)
                <div class="d-flex mx-2 justify-content-center">
                    <form action="{{ route('ajukan', $l->id_pengaduan) }}" method="post">
                        @csrf
                        <input type="text" value="proses" name="status" hidden>
                        <button type="submit" class="btn btn-primary">Ajukan Laporan</button>
                    </form>
                    <button type="button" class="btn btn-danger ml-2" data-dismiss="modal" data-toggle="modal" data-target="#hapus{{ $l->id_pengaduan }}">
                        Hapus
                      </button>
                </div>
                @elseif ($l->status == 'proses')
                <div class="alert alert-dark text-center" role="alert">
                    Menunggu di Tanggapi Petugas yang Bersangkutan
                  </div>
                @endif
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
 <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
 <script src=" {{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


 <!-- Custom scripts for all pages-->
 <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>


 <!-- Page level plugins -->
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

 <!-- Page level custom scripts -->
 <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>


@endsection
