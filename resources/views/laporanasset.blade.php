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
             </div>
             <!-- row -->
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <div class="card-header">
                             <h4 class="card-title">Asset</strong></u></h4>
                             <a href="{{url('laporan/asset/pdf')}}" class="btn btn-primary text-white">PDF <i class="fa-solid fa-file-pdf"></i></a>
                         </div>
                         <div class="card-body">
                             <div class="table-responsive">
                                 <table id="exampl" class="display table" style="min-width: 845px">
                                     <thead>
                                         <tr>
                                            <th>No</th>
                                            <th>ID Asset</th>
                                            <th>Nama Asset</th>
                                            <th>Lokasi</th>
                                            <th>Kondisi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     @php $no=0; @endphp
                                     @foreach ($asset as $value)
                                     @php $no++ @endphp
                                     <tr>
                                        <td>{{$no}}</td>
                                        <td>{{ $value->id_asset }}</td>
                                        <td>{{ $value->nama_asset }}</td>
                                        @foreach ($value->lokasi as $lokasi)
                                        <td>{{ $lokasi->nama_lokasi }}</td>
                                        @endforeach
                                        <td>{{ $value->kondisi }}</td>
                                        <td>
                                         <div class="btn-group">
                                             <a href="{{ url('asset/generateqr/') }}/{{ $value->id_asset }}"
                                                 class="btn btn-outline-dark btn-sm ">Unduh QR</a>
                                                 <a href="{{ url('asset/detil/') }}/{{ $value->id_asset }}"
                                                     class="btn btn-outline-primary btn-sm"><i
                                                     class="fas fa-eye"></i></a>
                                                     <a href="{{ url('asset/show/') }}/{{ $value->id_asset }}"
                                                         class="btn btn-outline-success btn-sm"><i
                                                         class="fa fa-edit"></i></a>
                                                         <button class="btn btn-outline-danger btn-sm"
                                                         data-toggle="modal"
                                                         data-target="#deleteasset{{ $no }}"><i
                                                         class="fa fa-trash"></i></button>
                                                         <div id="deleteasset{{ $no }}"
                                                         class="modal fade" tabindex="-1">
                                                         <div
                                                         class="modal-dialog model-sm modal-dialog-centered">
                                                         <div class="modal-content">
                                                             <div class="modal-body">
                                                                 <p class="font-weight-bold">Hapus data ini?
                                                                 </p>
                                                                 <p
                                                                 class="font-weight-bold text-danger text-center">
                                                                 Penghapusan ini hanya dilakukan ketika
                                                             ada kesalahan penginputan data!!</p>
                                                         </div>
                                                         <div class="modal-footer">
                                                             <button type="button"
                                                             class="btn btn-secondary"
                                                             data-dismiss="modal">Batal</button>
                                                             <form method="POST"
                                                             action="{{ url('asset') }}">
                                                             @csrf
                                                             @method('delete')
                                                             <input type="text" name="id_asset"
                                                             value="{{ $value->id_asset }}"
                                                             hidden>
                                                             <button type="submit"
                                                             class="btn btn-danger">Hapus</button>
                                                         </form>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
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

@endsection
