@extends('layouts.appUser')

@section('content')
<div class="d-flex justify-content-end">

</div>

<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<body id="page-top">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan</h6>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Tambah Laporan
          </button>
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
                            <th>ID Pengaduan</th>
                            <th>Judul</th>
                            <th>Jenis</th>
                            <th>isi_laporan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @foreach ( $pengaduan->where('id', Auth::user()->id)->where('status', '=', 'cancelled') as $p  )
                        <tr>
                            <td>{{ $p->id_pengaduan }}</td>
                            <td>{{ $p->judul }}</td>
                            <td>{{ $p->jenis }}</td>
                            <td>{{ $p->isi_laporan }}</td>
                            <td><div class="d-flex justify-content-center">
                                @if ($p->status == 'selesai')
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#detailTanggapan{{ $p->id_pengaduan }}">Lihat Tanggapan</button>
                                    @else
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail{{ $p->id_pengaduan }}">
                                        Detail
                                      </button>
                                    <button type="button" class="btn btn-danger ml-2" data-toggle="modal" data-target="#hapus{{ $p->id_pengaduan }}">
                                        Hapus
                                      </button>
                                @endif
                            </div></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>


    </body>


  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Laporan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                  <div class="card card-primary shadow">
                    <div class="card-body">
                      <form action="{{ route('tambah.laporan') }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <input type="text" hidden value="{{ Auth::user()->id }}" name="id">
                        <input type="text" hidden value="{{ uniqid() }}" name="imageName">
                        <div class="form-group">
                            <label for="inputStatus">Jenis Laporan</label>
                            <select id="inputStatus" class="form-control custom-select" name="jenis">
                              <option selected disabled>Select one</option>
                              <option value="agama">Agama</option>
                              <option value="politik">Politik</option>
                              <option value="ekonomi">Ekonomi</option>
                              <option value="bencana">Bencana</option>
                            </select>
                            @error('jenis')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        <div class="form-group">
                            <label for="inputName">Lokasi</label>
                            <input type="text" id="inputName" value="{{ old('lokasi') }}" name="lokasi" class="form-control">
                            @error('lokasi')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        <div class="form-group">
                            <label for="inputName">Judul</label>
                            <input type="text" id="inputName" value="{{ old('judul') }}" name="judul" class="form-control">
                            @error('judul')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        <div class="form-group">
                            <label for="inputName">Laporan</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="isi_laporan" rows="3"></textarea>
                            @error('isi_laporan')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="inputClientCompany">Foto</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">                            @error('file')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
      </div>
    </div>
  </div>
        </div>
    </div>
</div>

  @foreach ($pengaduan as $p)
      <!-- Modal -->
  <div class="modal fade" id="edit{{ $p->id_pengaduan }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit Laporan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                  <div class="card card-primary shadow">
                    <div class="card-body">
                      <form action="{{ route('update.laporan', $p->id_pengaduan) }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="inputName">Lokasi</label>
                            <input type="text" id="inputName" value="{{ $p->lokasi }}" name="lokasi" class="form-control">
                            @error('lokasi')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        <div class="form-group">
                            <label for="inputName">Judul</label>
                            <input type="text" id="inputName" value="{{ $p->judul }}" name="judul" class="form-control">
                            @error('judul')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        <div class="form-group">
                            <label for="inputName">Laporan</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="isi_laporan" rows="3">{{ $p->isi_laporan }}</textarea>
                            @error('isi_laporan')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
      </div>
    </div>
  </div>
        </div>
    </div>
</div>
  @endforeach

@foreach ($pengaduan as $p)
<div class="modal fade" id="detail{{ $p->id_pengaduan }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Detail Laporan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-header d-flex">
                    <p class="font-italic">{{ $p->jenis }}</p>
                    <p class="mx-2">|</p>
                    <p>{{ $p->lokasi }}</p>
                  </div>
                  <div class="card-body text-center">
                    <img class="card-img-top" src="images/{{ $p->foto }}" alt="Card image cap">
                    <h5 class="card-title mt-3 font-weight-bold">{{ $p->judul }}</h5>
                    <p class="card-text">{{ $p->isi_laporan }}</p>
                    @if ($p->status == 0)
                    <button type="button" class="btn btn-danger ml-2" data-dismiss="modal" data-toggle="modal" data-target="#edit{{ $p->id_pengaduan }}">
                        Edit Laporan
                      </button>
                    @endif
                  </div>

                  <div class="card-footer text-muted">
                    {{ $p->created_at }}
                  </div>
                </div>
        </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($tanggapan as $t)
<div class="modal fade" id="detailTanggapan{{ $t->id_pengaduan }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Detail Laporan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-header d-flex">
                    <p class="font-italic">{{ $p->jenis }}</p>
                    <p class="mx-2">|</p>
                    <p>{{ $p->lokasi }}</p>
                  </div>
                  <div class="card-body text-center">
                      <h5 class="card-title font-weight-bold">{{ $t->judul }}</h5>
                    <img class="card-img-top" src="images/{{ $t->foto }}" alt="Card image cap">
                    <p class="card-text mt-3">{{ $t->isi_laporan }}</p>
                    <div class="border p-3 mt-5 rounded">
                        <h6 class="text-left font-italic font-weight-bold">Tanggapan:</h6>
                        <p class="card-text">{{ $t->tanggapan }}</p>
                        <p class="card-text font-italic text-right">{{ $t->tgl_tanggapan }}</p>
                    </div>
                  </div>

                  <div class="card-footer text-muted">
                    {{ $t->created_at }}
                  </div>
                </div>
        </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($pengaduan as $p)
<div class="modal fade" id="hapus{{ $p->id_pengaduan }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLongTitle">Apakah Anda Ingin Menghapus Laporan?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body d-flex justify-content-center">
<a href="hapus/{{ $p->id_pengaduan }}/{{ $p->foto }}"><button class="btn btn-danger">hapus</button></a>
        </div>
        </div>
    </div>
</div>
@endforeach







@endsection

