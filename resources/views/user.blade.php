       @extends('main')

       @section('judul_halaman','Aset')

       @section('konten')
        <!--**********************************
            Content body start
            ***********************************-->
            <div class="content-body">
                <div class="container-fluid">
                    <div class="row page-titles mx-0">
                        <div class="col-sm-6 p-md-0">
                            <div class="welcome-text">
                                <h4>Hi, {{auth()->user()->nama_user}}!</h4>
                            </div>
                        </div>
                        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-capitalize"><a href="javascript:void(0)">{{Request::segment(1)}}</a></li>
                            </ol>
                        </div>
                    </div>
                    <!-- row -->
                    <div class="row text-dark">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Daftar User</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <a href="#tambahuser" data-toggle="modal" class="btn btn-primary btn-sm">Tambah User <i class="fa fa-plus text-white"></i></a>

                                        <div class="modal fade" id="tambahuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                            <form action="{{url('user')}}" method="POST">
                                                @csrf
                                                @method('post')
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah User</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label>Nama User</label>
                                                        <input type="text" name="nama_user" class="form-control" placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Username</label>
                                                        <input type="text" name="username" class="form-control" placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Password</label>
                                                        <input type="password" name="password" class="form-control" placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Email</label>
                                                        <input type="email" name="email" class="form-control" placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Telepon</label>
                                                        <input type="number" name="telepon" class="form-control" placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Hak Akses</label>
                                                        <select id="inputState" name="id_hak_akses" class="form-control">
                                                            <option selected value="">Pilih Hak Akses</option>
                                                            @foreach($hak_akses as $value)
                                                            <option value="{{$value->id_hak_akses}}">{{$value->nama_hak_akses}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button id="mutasi-asset" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-responsive-sm text-dark">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama User</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Hak Akses</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=0; @endphp
                                    @foreach($user as $value)
                                    @php $no++; @endphp
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>{{$value->nama_user}}</td>
                                        <td>{{$value->username}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>{{$value->telepon}}</td>
                                        <td>{{$value->nama_hak_akses}}</td>
                                        <td>
                                            @if(auth()->user()->id_hak_akses==2 AND $value->id_hak_akses == 1)
                                            @else
                                            <div class="btn-group">
                                                @if($value->username!==auth()->user()->username)
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteuser{{$no}}"><i class="fa fa-trash"></i></button>
                                                @endif
                                                <div id="deleteuser{{$no}}" class="modal fade" tabindex="-1">
                                                    <div class="modal-dialog model-sm modal-dialog-centered">
                                                        <div class="modal-content">
                                                          <div class="modal-body">
                                                            <p class="font-weight-bold">Hapus data ini?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <form method="POST" action="{{url('user')}}">
                                                                @csrf
                                                                @method('delete')
                                                                <input type="text" name="id_user" value="{{$value->id_user}}" hidden>
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($value->username!==auth()->user()->username)
                                            <a href="#edituser{{$value->id_user}}" data-toggle="modal" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                            @endif
                                            <div class="modal fade" id="edituser{{$value->id_user}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                <form method="POST" action="{{url('user')}}" class="mutasi-form">
                                                    @csrf
                                                    @method('patch');
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit User</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label>Nama User</label>
                                                            <input type="text" name="nama_user" class="form-control" placeholder="" value="{{$value->nama_user}}">
                                                            <input type="text" name="id_user" value="{{$value->id_user}}" hidden>
                                                            <input type="text" name="halaman" value="admin" hidden>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Username</label>
                                                            <input type="text" name="username" class="form-control" placeholder="" value="{{$value->username}}">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Email</label>
                                                            <input type="email" name="email" class="form-control" placeholder="" value="{{$value->email}}">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Telepon</label>
                                                            <input type="number" name="telepon" class="form-control" placeholder="" value="{{$value->telepon}}">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Hak Akses</label>
                                                            <select id="inputState" name="id_hak_akses" class="form-control">
                                                                <option selected value="">Pilih Hak Akses</option>
                                                                @foreach($hak_akses as $values)
                                                                <option value="{{$values->id_hak_akses}}" @if($values->id_hak_akses==$value->id_hak_akses) selected @endif>{{$values->nama_hak_akses}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
        <!--**********************************
            Content body end
            ***********************************-->

            @endsection