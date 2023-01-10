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
                   <!-- row -->
                   <div class="row">
                       <div class="col-12">
                           <div class="card">
                               <div class="card-header">
                                   <h4 class="card-title">Daftar Mutasi Asset <u><strong></strong></u></h4>
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
                                                               <p class="badge badge-warning text-white">Menunggu
                                                                   Persetujuan Kepala Sekolah</p>
                                                           @else
                                                               <p class="badge badge-danger text-white">Selesaikan Pengisian
                                                                   Data !</p>
                                                           @endif
                                                       </td>
                                                       <td>
                                                           <div class="btn-group">
                                                               <a href="{{ url('asset/mutasi/') }}/{{ $value->id_mutasi }}"
                                                                   class="btn btn-success"><i
                                                                       class="fa-solid fa-eye"></i></a>
                                                           </div>
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
