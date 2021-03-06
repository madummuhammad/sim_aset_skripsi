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
                                <span class="ml-1">Datatable</span>
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
                                    <h4 class="card-title">Dokumen Mutasi Asset</h4>
                                    @if($mutasi->status_mutasi==2)
                                    <a href="{{url('laporan/mutasi/pdf/')}}/{{Request::segment(3)}}" class="btn btn-primary">pdf <i class="fa-solid fa-file-pdf"></i></a>
                                    @endif
                                    @if($mutasi->status_mutasi==2)

                                    @elseif($mutasi->status_mutasi==1)

                                    @else
                                    <button data-target="#ubahmutasi" data-toggle="modal" class="btn btn-success">Ubah <i class="fas fa-edit"></i></button>
                                    <div class="modal fade" id="ubahmutasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                        <form action="{{url('asset/mutasi')}}" method="POST">
                                            @csrf
                                            @method('patch')
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Dokumen Mutasi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          <div class="modal-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>Nama</label>
                                                    <input type="text" name="nama" value="{{$mutasi->nama}}" class="form-control" placeholder="">
                                                    <input type="text" name="id_mutasi" value="{{$mutasi->id_mutasi}}" hidden>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Lokasi Mutasi</label>
                                                    <select id="inputState" name="lokasi" class="form-control">
                                                        <option selected value="">Pilih Lokasi...</option>
                                                        @foreach($lokasi as $value)
                                                        <option value="{{$value->kode_lokasi}}" @if($value->kode_lokasi==$mutasi->kode_lokasi) {{'selected'}}  @endif>{{$value->nama_lokasi}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Deskripsi</label>
                                                    <textarea name="deskripsi" id="" cols="30" rows="4" class="form-control">{{$mutasi->deskripsi}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button class="btn btn-primary" type="submit">Simpan Perubahan <i class="fa-solid fa-floppy-disk"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row py-2">
                            <div class="col-3">ID Mutasi</div>
                            <div class="col-7">: {{$mutasi->id_mutasi}}</div>
                        </div>
                        <div class="row py-2">
                            <div class="col-3">Nama Mutasi</div>
                            <div class="col-7">: {{$mutasi->nama}}</div>
                        </div>
                        <div class="row py-2">
                            <div class="col-3">Penanggung Jawab</div>
                            <div class="col-7">: {{$mutasi->nama_user}}</div>
                        </div>
                        <div class="row py-2">
                            <div class="col-3">Tanggal Pengajuan Mutasi</div>
                            <div class="col-7">: {{date('Y-m-d')}}</div>
                        </div>
                        <div class="row py-2">
                            <div class="col-3">Lokasi Mutasi</div>
                            <div class="col-7">: {{$mutasi->nama_lokasi}}</div>
                        </div>
                        <div class="row py-2">
                            <div class="col-3">Deskripsi</div>
                            <div class="col-7">: {{$mutasi->deskripsi}}</div>
                        </div><div class="row py-2">
                            <div class="col-3">Status</div>
                            <div class="col-7">:
                                @if($mutasi->status_mutasi==2)
                                <p class="badge badge-success text-white">Sudah Disetujui</p>
                                @elseif($mutasi->status_mutasi==1)
                                <p class="badge badge-warning text-white">Menunggu Persetujuan Kepala Sekolah</p>
                                @else
                                <p class="badge badge-danger text-white">Selesaikan Pengisian Data !</p>
                                @endif
                            </div>
                        </div>
                        @if($mutasi->status_mutasi==2)

                        @elseif($mutasi->status_mutasi==1)

                        @else
                        <a href="#tambahmutasi" data-toggle="modal" class="btn btn-primary btn-sm my-2">Tambah Aset <i class="fas fa-plus"></i></a>
                        <div class="modal fade" id="tambahmutasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <form action="{{url('asset/transaksi_mutasi')}}" method="POST">
                                @method('post')
                                @csrf
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Pilih Aset</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                <input type="text" value="{{$mutasi->id_mutasi}}" name="id_mutasi" hidden>
                                <select class="multi-select" name="id_asset[]" multiple="multiple">
                                    @foreach($inventory as $value)
                                    <option value="{{$value->id_asset}}">{{$value->id_asset.' - '.$value->nama_asset}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-responsive-sm text-dark">
                    <thead>
                        <tr>
                            <!-- <th>
                                <input type="checkbox" class="main-checkbox">
                            </th> -->
                            <th>Kode Asset</th>
                            <th>Nama Asset</th>
                            <th>Harga Per Satuan</th>
                            <th>Lokasi Mutasi</th>
                            <th>Lokasi Sebelumnya</th>
                            <th>Kondisi</th>
                            <th>Tanggal Input</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach($asset as $value)
                        <tr>
                            <!-- <td>
                                <input type="checkbox" class="inventory-check" value="{{$value->id_asset}}">
                            </td> -->
                            <td>{{$value->id_asset}}</td>
                            <td>{{$value->nama_asset}}</td>
                            <td>{{$value->harga_satuan}}/{{$value->satuan}}</td>
                            <td>{{$mutasi->nama_lokasi}}</td>
                            <td>{{DB::table('lokasi')->where('kode_lokasi',$value->kode_lokasi_sebelumnya)->first()->nama_lokasi}}</td>
                            <td>{{$value->kondisi}}</td>
                            <td>{{$value->tgl_input}}</td>
                            <td>
                                @if($mutasi->status_mutasi==0)
                                <form action="{{url('asset/transaksi_mutasi')}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="text" name="id_mutasi" value="{{$mutasi->id_mutasi}}" hidden>
                                    <input type="text" name="id_asset" value="{{$value->id_asset}}" hidden>
                                    <input type="text" name="id_transaksi" value="{{$value->id_transaksi}}" hidden>
                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa-solid fa-ban"></i></button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{url('asset/mutasi')}}" class="btn btn-warning mx-2"><i class="fa-solid fa-angle-left"></i> Kembali</a>
                @if($mutasi->status_mutasi==2)
                @elseif($mutasi->status_mutasi==1)
                <form action="{{url('asset/mutasi')}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="id_mutasi" value="{{$mutasi->id_mutasi}}" hidden>
                    <input type="text" name="status" value="0" hidden>
                    <button class="btn btn-danger mx-2"><i class="fa-solid fa-ban"></i> Batalkan Pengajuan</button>
                </form>
                @else
                <button class="btn btn-danger mx-2" data-toggle="modal" data-target="#deletemutasi"><i class="fa-solid fa-ban"></i> Batal Pengisian</button>
                <div id="deletemutasi" class="modal fade" tabindex="-1">
                    <div class="modal-dialog model-sm modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-body">
                            <p class="font-weight-bold my-0 text-center">Anda yakin akan membatalkan pengisian data mutasi ini?</p>
                            <p class="font-weight-bold text-danger my-0 text-center">Semua data yang di isi akan terhapus!!</p>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <form action="{{url('asset/mutasi')}}" method="POST">
                                @csrf
                                @method('delete')
                                @foreach($asset as $value)
                                <input type="text" name="id_asset[]" value="{{$value->id_asset}}" hidden>
                                @endforeach
                                <input type="text" name="id_mutasi" value="{{$mutasi->id_mutasi}}" hidden>
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{url('asset/mutasi')}}" method="POST">
                @csrf
                @method('PATCH')
                <input type="text" name="id_mutasi" value="{{$mutasi->id_mutasi}}" hidden>
                <input type="text" name="status" value="1" hidden>
                <button class="btn btn-success mx-2"><i class="fa-solid fa-floppy-disk"></i> Ajukan Mutasi</button>
            </form>
            @endif
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