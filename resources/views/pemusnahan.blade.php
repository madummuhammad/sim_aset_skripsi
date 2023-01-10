       @extends('main')

       @section('judul_halaman', 'Pemusnahan')

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
                 <!-- row -->
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
                                                 <th>Nama Pemusnahan</th>

                                                 <th>Deskripsi</th>
                                                 <th>Status</th>
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
                                                   @else
                                                   <p class="badge badge-outline-danger text-danger">Ditolak</p>
                                                   @endif
                                               </td>
                                               <td>
                                                 <div class="btn-group">
                                                     <a href="{{ url('asset/pemusnahan/') }}/{{ $value->id_pemusnahan }}"
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
                                                 <th>Nama Mutasi</th>

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
