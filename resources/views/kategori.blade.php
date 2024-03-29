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
                                <span>Halaman ini digunakan untuk melihat data master kategori</span>
                            </div>
                        </div>
                        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                            <ol class="breadcrumb">

                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Kategori Aset</strong></u></h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <a href="#tambahkategori" data-toggle="modal" class="btn btn-primary btn-sm">Tambah Kategori <i class="fa fa-plus text-white"></i></a>

                                        <div class="modal fade" id="tambahkategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                            <form method="POST" action="{{url('kategori')}}" class="mutasi-form">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Kategori</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                  </button>
                                              </div>
                                              <div class="modal-body">
                                                @csrf
                                                @method('post')
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label>ID Kategori</label>
                                                        @if($id_kategori==NULL)
                                                        <input type="text" name="id_kategori" class="form-control" placeholder="" value="{{$id_kategori}}" readonly>
                                                        @else
                                                        <input type="text" name="id_kategori" class="form-control" placeholder="" value="{{$id_kategori}}" readonly>
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Nama Kategori</label>
                                                        <input type="text" name="nama_kategori" class="form-control" placeholder="">
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
                                        <th>Kode Kategori</th>
                                        <th>Nama Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=1; @endphp
                                    @foreach($kategori as $value)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$value->id_kategori_asset}}</td>
                                        <td>{{$value->nama_kategori}}</td>
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
                                                            <form method="POST" action="{{url('kategori')}}">
                                                                @csrf
                                                                @method('delete')
                                                                <input type="text" name="id_kategori" value="{{$value->id_kategori_asset}}" hidden>
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#editkategori{{$no}}" data-toggle="modal" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                            <div class="modal fade" id="editkategori{{$no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <form method="POST" action="{{url('kategori')}}" class="mutasi-form">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Kategori</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        @csrf
                                                        @method('patch')
                                                        <div class="form-row">

                                                            <div class="form-group col-md-12">
                                                                <label>ID Kategori</label>
                                                                <input type="text" name="id_kategori" class="form-control" placeholder="" value="{{$value->id_kategori_asset}}">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label>Nama Kategori</label>
                                                                <input type="text" name="nama_kategori" class="form-control" placeholder="" value="{{$value->nama_kategori}}">
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
                            <th>Kode Kategori</th>
                            <th>Nama Kategori</th>
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