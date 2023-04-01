@extends('layouts.appUser')

@section('content')


<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<body id="page-top">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Laporan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Laporan <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
          </svg></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
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
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            @foreach ( $pengaduan->where('id', Auth::user()->id)->where('status', '!=', 'cancelled') as $p  )
                                <tr>
                                    <td>{{ $p->id_pengaduan }}</td>
                                    <td>{{ $p->judul }}</td>
                                    <td>{{ $p->jenis }}</td>
                                    <td class="d-flex justify-content-center">
                                        @if ($p->status == 0)
                                        <p>menunggu konfirmasi</p>
                                        @elseif ($p->status == 'proses')
                                        <p>proses</p>
                                        @elseif ($p->status == 'selesai')
                                        <p>selesai</p>
                                        @elseif ($p->status == 'cancelled')
                                        <p>Laporan Anda di Tolak</p>
                                        @endif
                                    </td>
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
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">Laporan yang di Tolak</h6>
                </div>
                <tbody>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tanggal Pengaduan</th>
                                    <th>Judul</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            @foreach ( $pengaduan->where('id', Auth::user()->id)->where('status', '=', 'cancelled') as $p  )
                                <tr>
                                    <td>{{ $p->created_at }}</td>
                                    <td>{{ $p->judul }}</td>
                                    <td>{{ $p->jenis }}</td>
                                    <td class="d-flex justify-content-center">
                                        <p>Laporan Anda di Tolak</p>
                                    </td>
                                    <td><div class="d-flex justify-content-center">
                                        @if ($p->status == 'selesai')
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#detailTanggapan{{ $p->id_pengaduan }}">Lihat Tanggapan</button>
                                            @else
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailGagal{{ $p->id_pengaduan }}">
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
                        @if (count($pengaduan->where('id', Auth::user()->id)->where('status', 'cancelled')) == 0)
                        <div class="alert alert-success" role="alert">
                            Tidak Ada Laporan yang di Tolak
                          </div>
                        @endif

                    </div>
        </div>
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
                              <option value="agama" value="agama">Agama</option>
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
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="isi_laporan" rows="3">{{ old('isi_laporan') }}</textarea>
                            @error('isi_laporan')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="inputClientCompany">Foto</label>
                            <input type="file" class="form-control-file" id="imgInp" name="image" value="{{ old('image') }}" required>
                            <img id="blah" class="mt-2 mx-auto d-block img-fluid">
                            @error('image')
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
                        <input type="text" hidden value="{{ $p->jenis }}" name="jenis">
                        <input type="text" hidden value="{{ $p->foto }}" name="oldImage">
                        <input type="text" hidden value="{{ uniqid() }}" name="imageName">
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
                          <div class="form-group">
                            <label for="inputClientCompany">Foto</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
                            @error('image')
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
                    <button type="button" class="btn btn-info ml-2" data-dismiss="modal" data-toggle="modal" data-target="#edit{{ $p->id_pengaduan }}">
                        Edit Laporan
                      </button>
                      <button type="button" class="btn btn-danger ml-2" data-toggle="modal" data-target="#hapus{{ $p->id_pengaduan }}">
                        Hapus
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

@foreach ($pengaduan as $p)
<div class="modal fade" id="detailGagal{{ $p->id_pengaduan }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <p class="card-text">{{ $p->isi_laporan }}</p>
                  </div>

                  <div class="card-footer text-muted">
                    {{ $p->updated_at }}
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

<script>
    imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}

</script>
<script>
    imgEdt.onchange = evt => {
  const [file] = imgEdt.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}

</script>






@endsection

