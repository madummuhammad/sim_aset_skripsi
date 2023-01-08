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

                            </ol>
                        </div>
                    </div>
                    <!-- row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Jenis Aset</strong></u></h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <a href="#tambahjenis" data-toggle="modal" class="btn btn-primary btn-sm">Tambah Jenis <i class="fa fa-plus text-white"></i></a>
                                        <div class="modal fade" id="tambahjenis" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                            <form method="POST" action="{{url('jenis_asset')}}" class="mutasi-form">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Jenis Asset</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                @csrf
                                                @method('post')
                                                <div class="form-row">

                                                    <div class="form-group col-md-12">
                                                        <label>ID Jenis Asset</label>
                                                        @if($id_jenis_asset==NULL)
                                                        <input type="text" name="id_jenis" class="form-control" placeholder="" value="{{$id_jenis_asset}}" readonly>
                                                        @else
                                                        <input type="text" name="id_jenis" class="form-control" placeholder="" value="{{$id_jenis_asset}}" readonly>
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Nama Jenis</label>
                                                        <input type="text" name="nama_jenis" class="form-control" placeholder="">
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
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Jenis</th>
                                        <th>Nama Jenis</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=1; @endphp
                                    @foreach($jenis_asset as $value)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$value->id_jenis_asset}}</td>
                                        <td>{{$value->nama_jenis}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteinventory{{$no}}"><i class="fa fa-trash"></i></button>
                                                <div id="deleteinventory{{$no}}" class="modal fade" tabindex="-1">
                                                    <div class="modal-dialog model-sm modal-dialog-centered">
                                                        <div class="modal-content">
                                                          <div class="modal-body">
                                                            <p class="font-weight-bold">Hapus data ini?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <form method="POST" action="{{url('jenis_asset')}}">
                                                                @csrf
                                                                @method('delete')
                                                                <input type="text" name="id_jenis" value="{{$value->id_jenis_asset}}" hidden>
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#editjenis{{$no}}" data-toggle="modal" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                            <div class="modal fade" id="editjenis{{$no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <form method="POST" action="{{url('jenis_asset')}}" class="mutasi-form">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Jenis Asset</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        @csrf
                                                        @method('patch')
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12">
                                                                <label>ID Jenis Asset</label>
                                                                <input type="text" name="id_jenis" class="form-control" placeholder="" value="{{$value->id_jenis_asset}}" readonly>
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label>Nama Jenis Asset</label>
                                                                <input type="text" name="nama_jenis" class="form-control" placeholder="" value="{{$value->nama_jenis}}">
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
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>ID Jenis</th>
                            <th>Nama Jenis</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
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