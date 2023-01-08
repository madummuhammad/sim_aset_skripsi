       @extends('main')

       @section('judul_halaman', 'Mutasi')

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
                                                   <th>Nama Mutasi</th>
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
                                                       <td>{{ $value->nama }}</td>
                                                       @foreach ($value->lokasi as $lokasi)
                                                           <td>{{ $lokasi->nama_lokasi }}</td>
                                                       @endforeach
                                                       <td>{{ $value->deskripsi }}</td>
                                                       <td>
                                                           @if ($value->status_mutasi == 'Sudah Disetujui')
                                                               <p class="badge badge-success text-white">Sudah Disetujui</p>
                                                           @elseif($value->status_mutasi == 'Proses Pengajuan')
                                                               <p class="badge badge-warning text-white">Belum Disetujui</p>
                                                           @else
                                                               <p class="badge badge-danger text-white">Data belum selesai !
                                                               </p>
                                                           @endif
                                                       </td>
                                                       <td>
                                                           <div class="btn-group">
                                                               <a href="{{ url('laporan/mutasi/') }}/{{ $value->id_mutasi }}"
                                                                   class="btn btn-outline-success btn-rounded mr-2"><i
                                                                       class="fa-solid fa-eye"></i></a>
                                                               @if ($value->status_mutasi == 'Proses Pengajuan' or $value->status_mutasi == 'Sudah Disetujui')
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
                                                                       @if ($value->status_mutasi == 'Proses Pengajuan')
                                                                           <button type="submit"
                                                                               class="btn btn-light btn-rounded">Konfirmasi</button>
                                                                       @else
                                                                           <button type="submit"
                                                                               class="btn btn-success btn-rounded"><i
                                                                                   class="fa-solid fa-check"></i></button>
                                                                       @endif
                                                                   </form>
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
