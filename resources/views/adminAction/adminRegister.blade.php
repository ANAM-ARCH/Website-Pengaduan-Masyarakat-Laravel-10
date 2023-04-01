@extends('layouts.appAdmin')

@section('content')
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<body id="page-top">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-right">Petugas dan Admin</h6>
            <!-- Button trigger modal -->
<div class="d-flex">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Tambah Petugas
      </button>
</div>
        </div>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">User</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Petugas</a>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
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
                                    <th>Nama</th>
                                    <th>Tipe Pengguna</th>
                                    <th>Aksi</th>
                                    <th hidden>NIK</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $users->whereIn('type', ['user', 'banned']) as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td> {{ $user->type }} </td>
                                    <td hidden> {{ $user->nik }} </td>
                                    <td><div class="d-flex justify-content-center">
                                        @if ($user->type == 'user')
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail{{ $user->id }}">
                                            Detail
                                        </button>
                                        @else
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail{{ $user->id }}">
                                            Detail
                                        </button>
                                        <button type="button" class="btn btn-success mx-2" data-toggle="modal" data-target="#pulihkan{{ $user->id }}">
                                            Pulihkan Akun
                                        </button>
                                        @endif
                                    </div></td>
                                </tr>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="card-body">
                    @if(session()->has('message'))
                     <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @else
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="petugas" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Terakhir di Lihat</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $users->where('type', 'petugas') as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td> {{ $user->jenis }} </td>
                                    <td>
                                        {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                                    </td>
                                    <td>
                                        @if(Cache::has('user-is-online-' . $user->id))
                                            <span class="text-success">Online</span>
                                        @else
                                            <span class="text-secondary">Offline</span>
                                        @endif
                                    </td>
                                    <td><div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#petugas{{ $user->id }}">
                                            Detail
                                        </button>
                                    </div></td>
                                </tr>
                                @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    </div>




  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Petugas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                  <div class="card card-primary shadow">
                    <div class="card-body">
                      <form action="{{ route('admin.register') }}" method="POST">
                        @csrf
                        <input type="text" value="{{ uniqid() }}" name="id_petugas" hidden>
                        <input type="text" value="2" name="type" hidden>
                        <div class="form-group">
                            <label for="inputName">Nama</label>
                            <input type="text" id="inputName" value="{{ old('nama') }}" name="nama" class="form-control">
                            @error('nama')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        <div class="form-group">
                            <label for="inputName">Username</label>
                            <input type="text" id="inputName" value="{{ old('username') }}" name="username" class="form-control">
                            @error('username')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="inputStatus">Jenis Petugas</label>
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
                            <label for="inputClientCompany">Telephone</label>
                            <input type="number" id="inputClientCompany" value="{{ old('telp') }}" name="telp" class="form-control">
                            @error('telp')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="inputProjectLeader">Password</label>
                            <input type="password" id="inputProjectLeader" name="password" class="form-control">
                            <div class="input-group-addon">

                            @error('password')
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
        </div></div></div></div>

        @foreach ($users as $user)
        <div class="modal fade" id="detail{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Detail Akun</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                        <div class="card-header">
                            <pre>ID          : {{ $user->id }}</pre>
                            <pre>NIK         : {{ $user->nik }}</pre>
                            <pre>Nama        : {{ $user->nama }}</pre>
                            <pre>Username    : {{ $user->username }}</pre>
                            <pre>Telp        : {{ $user->telp }}</pre>
                            <pre>Akun diBuat : {{ $user->created_at }}</pre>
                          </div>
                      <div class="card-body text-center">
                      </div>

                      <div class="card-footer text-muted">
                        @if ($user->type == 'user')
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ban{{ $user->id }}">
                            Ban Akun
                        </button>
                        @endif
                      </div>
                    </div>
                </div>
                </div>
            </div>
        @endforeach


        @foreach ($users as $user)
<div class="modal fade" id="ban{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLongTitle">Apakah Anda Ingin Ban Pengguna?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body d-flex justify-content-center">
<a href="ban/{{ $user->id }}"><button class="btn btn-danger">Ya!</button></a>
        </div>
        </div>
    </div>
</div>
@endforeach
        @foreach ($users as $user)
<div class="modal fade" id="pulihkan{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLongTitle">Apakah Anda Ingin Memulihkan Pengguna?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body d-flex justify-content-center">
<a href="pulihkan/{{ $user->id }}"><button class="btn btn-success">Ya!</button></a>
        </div>
        </div>
    </div>
</div>
@endforeach
@foreach ($users as $user)
<div class="modal fade" id="hapus{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="exampleModalLongTitle">Apakah Anda Ingin Menghapus Petugas?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body d-flex justify-content-center">
<a href="hapus/petugas/{{ $user->id }}"><button class="btn btn-danger">hapus</button></a>
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
