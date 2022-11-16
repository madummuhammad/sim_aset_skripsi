       @extends('main')

       @section('judul_halaman', 'Aset')

       @section('konten')
           <div class="content-body">
               <div class="container-fluid">
                   <div class="row page-titles mx-0">
                       <div class="col-sm-6 p-md-0">
                           <div class="welcome-text">
                               <h4>Hi, {{ auth()->user()->nama_user }}!</h4>
                               <span class="ml-1">Datatable</span>
                           </div>
                       </div>
                       <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                           <ol class="breadcrumb">
                               <li class="breadcrumb-item text-capitalize"><a
                                       href="javascript:void(0)">{{ Request::segment(1) }}</a></li>
                           </ol>
                       </div>
                   </div>
                   <div class="row text-dark">
                       <div class="col-12">
                           <div class="card">
                               <div class="card-header">
                                   <h4 class="card-title">Dokumen Mutasi Asset</h4>
                                   @if ($mutasi->status_mutasi == 'Sudah Disetujui')
                                       <a href="{{ url('laporan/mutasi/pdf/') }}/{{ Request::segment(3) }}"
                                           class="btn btn-primary">pdf <i class="fa-solid fa-file-pdf"></i></a>
                                   @endif
                               </div>
                               <div class="card-body">
                                   <div class="row py-2">
                                       <div class="col-3">ID Mutasi</div>
                                       <div class="col-7">: {{ $mutasi->id_mutasi }}</div>
                                   </div>
                                   <div class="row py-2">
                                       <div class="col-3">Nama Mutasi</div>
                                       <div class="col-7">: {{ $mutasi->nama }}</div>
                                   </div>
                                   <div class="row py-2">
                                       <div class="col-3">Penanggung Jawab</div>
                                       @foreach ($mutasi->users as $user)
                                           <div class="col-7">: {{ $user->nama_user }}</div>
                                       @endforeach
                                   </div>
                                   <div class="row py-2">
                                       <div class="col-3">Tanggal Pengajuan Mutasi</div>
                                       <div class="col-7">: {{ date('Y-m-d') }}</div>
                                   </div>
                                   <div class="row py-2">
                                       <div class="col-3">Lokasi Mutasi</div>
                                       @foreach ($mutasi->lokasi as $lokasi)
                                           <div class="col-7">: {{ $lokasi->nama_lokasi }}</div>
                                       @endforeach
                                   </div>
                                   <div class="row py-2">
                                       <div class="col-3">Deskripsi</div>
                                       <div class="col-7">: {{ $mutasi->deskripsi }}</div>
                                   </div>
                                   <div class="row py-2">
                                       <div class="col-3">Status</div>
                                       <div class="col-7">:
                                           @if ($mutasi->status_mutasi == 'Sudah Disetujui')
                                               <p class="badge badge-success text-white">Sudah Disetujui</p>
                                           @elseif($mutasi->status_mutasi == 'Proses Pengajuan')
                                               <p class="badge badge-warning text-white">Menunggu Persetujuan Kepala Sekolah
                                               </p>
                                           @else
                                               <p class="badge badge-danger text-white">Data Belum Diajukan !</p>
                                           @endif
                                       </div>
                                   </div>
                                   <div class="table-responsive mt-3">
                                       <table class="table table-bordered table-responsive-sm text-dark">
                                           <thead>
                                               <tr>
                                                   <th>Kode Asset</th>
                                                   <th>Nama Asset</th>
                                                   <th>Harga Per Satuan</th>
                                                   <th>Lokasi Sebelumnya</th>
                                                   <th>Kondisi</th>
                                                   <th>Tanggal Input</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                               @php $no=1; @endphp
                                               @foreach ($asset as $value)
                                                   <tr>
                                                       <td>{{ $value->id_asset }}</td>
                                                       @foreach ($value->asset as $assets)
                                                           <td>{{ $assets->nama_asset }}</td>
                                                           <td>{{ $assets->harga_satuan }}/{{ $assets->satuan }}</td>
                                                           <td>{{ DB::table('lokasi')->where('kode_lokasi', $value->kode_lokasi_sebelumnya)->first()->nama_lokasi }}
                                                           </td>
                                                           <td>{{ $assets->kondisi }}</td>
                                                           <td>{{ $assets->created_at }}</td>
                                                       @endforeach
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
       @endsection
