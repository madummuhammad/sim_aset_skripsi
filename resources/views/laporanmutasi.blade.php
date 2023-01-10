       @extends('main')

       @section('judul_halaman', 'Mutasi')

       @section('konten')
       <div class="content-body">
           <div class="container-fluid">
               <div class="row page-titles mx-0">
                   <div class="col-sm-6 p-md-0">
                       <div class="welcome-text">
                           <h4>Hi, {{ auth()->user()->nama_user }}!</h4>
                           <span>Halaman ini digunakan untuk melihat list data usulan mutasi</span>
                       </div>
                   </div>
                   </div>
                   <div class="row">
                       <div class="col-12">
                           <div class="card">
                               <div class="card-header">
                                   <h4 class="card-title">Asset <u><strong></strong></u></h4>
                               </div>
                               <div class="card-body">
                                   <div class="table-responsive">
                                       <table id="example" class="display" style="min-width: 845px">
                                           <thead>
                                               <tr>
                                                   <th>No</th>
                                                   <th>Kode Mutasi</th>
                                                   <th>Lokasi Mutasi</th>
                                                   <th>Deskripsi</th>
                                                   <th>Status</th>
                                                   <th>Lihat</th>
                                                   <th>Aksi</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               @php $no=0 @endphp
                                               @foreach ($mutasi as $value)
                                               @php $no++ @endphp
                                               <tr>
                                                   <td>{{ $no }}</td>
                                                   <td>{{ $value->id_mutasi }}</td>
                                                   @foreach ($value->lokasi as $lokasi)
                                                   <td>{{ $lokasi->nama_lokasi }}</td>
                                                   @endforeach
                                                   <td>{{ $value->deskripsi }}</td>
                                                   <td>
                                                       @if ($value->status_mutasi == 'Sudah Disetujui')
                                                       <p class="badge badge-success text-white">Sudah Disetujui</p>
                                                       @elseif($value->status_mutasi == 'Proses Pengajuan')
                                                       <p class="badge badge-warning text-white">Belum Disetujui</p>
                                                       @elseif($value->status_mutasi=='Proses Mutasi')
                                                       <p class="badge badge-danger text-white">Data belum selesai !
                                                       </p>
                                                       @else
                                                       <p class="badge badge-outline-danger text-danger">Ditolak
                                                       </p>
                                                       @endif
                                                   </td>
                                                   <td>
                                                       <div class="btn-group">
                                                           <a href="{{ url('laporan/mutasi/') }}/{{ $value->id_mutasi }}"
                                                            class="btn btn-outline-success btn-sm btn-rounded mr-2"><i
                                                            class="fa-solid fa-eye"></i></a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                       @if ($value->status_mutasi == 'Proses Pengajuan' or $value->status_mutasi == 'Sudah Disetujui')
                                                       <div class="btn-group">
                                                        @if ($value->status_mutasi == 'Proses Pengajuan')
                                                        <button class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#konfirmasi">Konfirmasi</button>
                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#tolak">Tolak</button>
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
                                                                    <p class="font-weight-bold text-warning m-0">Anda yakin akan mengonfirmasi mutasi?</p>
                                                                    <p class="text-warning font-weight-bold m-0">Data yang dikonfirmasi tidak bisa dibatalkan!!</p>
                                                                </div>
                                                            </div>
                                                            <form action="{{ url('laporan/mutasi') }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('patch')
                                                            <input type="text" name="status"
                                                            value="{{ $value->status_mutasi }}" hidden>
                                                            <input type="text" name="id_mutasi"
                                                            value="{{ $value->id_mutasi }}" hidden>
                                                            @foreach ($value->lokasi as $lokasi)
                                                            <input type="text" name="kode_lokasi"
                                                            value="{{ $lokasi->kode_lokasi }}" hidden>
                                                            @endforeach
                                                            <div class="d-flex justify-content-end">
                                                                <button type="submit"
                                                                class="btn btn-outline-warning btn-sm">Konfirmasi</button>
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
                                                    <p class="font-weight-bold text-danger m-0">Anda yakin akan menolak pengajuan mutasi?</p>
                                                    <p class="text-danger font-weight-bold m-0">Data yang ditolak tidak bisa dibatalkan</p>
                                                </div>
                                            </div>
                                            <form action="{{ url('laporan/mutasi') }}"
                                            method="POST">
                                            @csrf
                                            @method('patch')
                                            <input type="text" name="status"
                                            value="Ditolak" hidden>
                                            <input type="text" name="id_mutasi"
                                            value="{{ $value->id_mutasi }}" hidden>
                                            @foreach ($value->lokasi as $lokasi)
                                            <input type="text" name="kode_lokasi"
                                            value="{{ $lokasi->kode_lokasi }}" hidden>
                                            @endforeach
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
           <tr>
               <th>No</th>
               <th>Kode Mutasi</th>
               <th>Lokasi Mutasi</th>
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
