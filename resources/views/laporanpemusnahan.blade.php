       @extends('main')

       @section('judul_halaman', 'Mutasi')

       @section('konten')
       <div class="content-body">
         <div class="container-fluid">
             <div class="row page-titles mx-0">
                 <div class="col-sm-6 p-md-0">
                     <div class="welcome-text">
                         <h4>Hi, {{ auth()->user()->nama_user }}!</h4>
                         <span>Halaman ini digunakan untuk melihat list data pemusnahan aset yang diajukan</span>
                     </div>
                 </div>
                 </div>
                 <div class="row">
                     <div class="col-12">
                         <div class="card">
                             <div class="card-header">
                                 <h4 class="card-title">Pemusnahan Asset <u><strong></strong></u></h4>
                             </div>
                             <div class="card-body">
                                 <div class="table-responsive">
                                     <table id="example" class="display" style="min-width: 845px">
                                         <thead>
                                             <tr>
                                                 <th>No</th>
                                                 <th>Kode Pemusnahan</th>
                                                 <th>Alasan Pemusnahan</th>
                                                 <th>Deskripsi</th>
                                                 <th>Status</th>
                                                 <th>Lihat</th>
                                                 <th>Aksi</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             @php $no=0 @endphp
                                             @foreach ($pemusnahan as $value)
                                             @php $no++ @endphp
                                             <tr>
                                                 <td>{{ $no }}</td>
                                                 <td>{{ $value->id_pemusnahan }}</td>
                                                 <td>{{ $value->nama }}</td>
                                                 @foreach ($value->lokasi as $lokasi)
                                                 <td>{{ $lokasi->nama_lokasi }}</td>
                                                 @endforeach
                                                 <td>{{ $value->deskripsi }}</td>
                                                 <td>
                                                    @if ($value->status_pemusnahan == 'Sudah Disetujui')
                                                    <p class="badge badge-success text-white">Sudah Disetujui</p>
                                                    @elseif($value->status_pemusnahan == 'Proses Pengajuan')
                                                    <p class="badge badge-warning text-white">Menunggu Persetujuan Kepala Sekolah
                                                    </p>
                                                    @elseif($value->status_pemusnahan=='Proses Pemusnahan')
                                                    <p class="badge badge-danger text-white">Selesaikan Pengisian Data !</p>
                                                    @elseif($value->status_pemusnahan=='Sudah Dilaksanakan')
                                                    <p class="badge badge-outline-success text-success">Sudah Dilaksanakan</p>
                                                    @elseif($value->status_pemusnahan=='Ditolak')
                                                    <p class="badge badge-outline-danger text-danger">Ditolak</p>
                                                    @endif
                                                </td>
                                                <td>
                                                 <div class="btn-group">
                                                     <a href="{{ url('laporan/pemusnahan/') }}/{{ $value->id_pemusnahan }}"
                                                         class="btn btn-sm btn-outline-success btn-rounded mr-2"><i
                                                         class="fa-solid fa-eye"></i></a>
                                                     </div>
                                                 </td>
                                                 <td>
                                                    <div class="btn-group">
                                                     @if ($value->status_pemusnahan == 'Proses Pengajuan' or $value->status_pemusnahan == 'Sudah Disetujui')
                                                     @if ($value->status_pemusnahan == 'Proses Pengajuan')
                                                     <button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#konfirmasi">Konfirmasi</button>
                                                     <button class="btn btn-sm btn-danger"  data-toggle="modal" data-target="#tolak">Tolak</button>
                                                     @else
                                                     @endif
                                                     <div id="konfirmasi" class="modal fade" tabindex="-1">
                                                       <div class="modal-dialog model-sm modal-dialog-centered">
                                                         <div class="modal-content">
                                                             <div class="modal-body">
                                                              <div class="d-flex">                          
                                                                <div class="text-warning pr-4" style="font-size: 40px;">
                                                                  <i class="fa-solid fa-exclamation"></i>
                                                              </div>
                                                              <div>
                                                                <p class="font-weight-bold text-warning m-0">Anda yakin akan mengonfirmasi pengajuan pemusnahan?</p>
                                                                <p class="text-warning font-weight-bold m-0">Data yang dikonfirmasi tidak bisa dibatalkan!!</p>
                                                            </div>
                                                        </div>
                                                        <form action="{{ url('laporan/pemusnahan') }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('patch')
                                                        <input type="text" name="status"
                                                        value="{{ $value->status_pemusnahan }}" hidden>
                                                        <input type="text" name="id_pemusnahan"
                                                        value="{{ $value->id_pemusnahan }}" hidden>
                                                        <div class="d-flex justify-content-end">
                                                            <button type="submit"
                                                            class="btn btn-sm btn-outline-warning">Konfirmasi</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tolak" class="modal fade" tabindex="-1">
                                     <div class="modal-dialog model-sm modal-dialog-centered">
                                       <div class="modal-content">
                                           <div class="modal-body">
                                              <div class="d-flex">                          
                                                <div class="text-danger pr-4" style="font-size: 40px;">
                                                  <i class="fa-solid fa-exclamation"></i>
                                              </div>
                                              <div>
                                                <p class="font-weight-bold text-danger m-0">Anda yakin akan menolak pengajuan pemusnahan?</p>
                                                <p class="text-danger font-weight-bold m-0">Data yang ditolak tidak bisa dibatalkan</p>
                                            </div>
                                        </div>
                                        <form action="{{ url('laporan/pemusnahan') }}"
                                        method="POST">
                                        @csrf
                                        @method('patch')
                                        <input type="text" name="status"
                                        value="Ditolak" hidden>
                                        <input type="text" name="id_pemusnahan"
                                        value="{{$value->id_pemusnahan}}" hidden>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-sm btn-danger">Tolak</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
     <tr>
         <th>No</th>
         <th>Kode Mutasi</th>
         <th>Nama Mutasi</th>
         <th>Deskripsi</th>
         <th>Status</th>
         <th>Lihat</th>
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

@endsection
