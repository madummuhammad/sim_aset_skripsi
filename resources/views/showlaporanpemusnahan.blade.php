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
                                <h4 class="card-title">Detail Pemusnahan Aset {{$pemusnahan->id_pemusnahan}}</h4>
                                @if ($pemusnahan->status_pemusnahan == 'Sudah Disetujui')
                                <form action="{{url('laporan/pemusnahan/konfirmasi_bukti')}}" method="POST">
                                    @method('POST')
                                    @csrf
                                    <input type="text" name="id_pemusnahan" value="{{$pemusnahan->id_pemusnahan}}" hidden>
                                    <button  class="btn btn-primary">Konfirmasi Bukti</button>
                                </form>
                                @endif

                                @if($pemusnahan->status_pemusnahan=='Sudah Dilaksanakan')
                                <a href="{{ url('laporan/pemusnahan/pdf/') }}/{{ Request::segment(3) }}"
                                class="btn btn-primary">Berita Acara <i class="fa-solid fa-file-pdf"></i></a>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="row">
                                 <div class="col-8">
                                  <div class="row py-2">
                                   <div class="col-3">ID pemusnahan</div>
                                   <div class="col-7">: {{ $pemusnahan->id_pemusnahan }}</div>
                               </div>
                               <div class="row py-2">
                                   <div class="col-3">Alasan pemusnahan</div>
                                   <div class="col-7">: {{ $pemusnahan->nama }}</div>
                               </div>
                               <div class="row py-2">
                                   <div class="col-3">Penanggung Jawab</div>
                                   @foreach ($pemusnahan->users as $user)
                                   <div class="col-7">: {{ $user->nama_user }}</div>
                                   @endforeach
                               </div>
                               <div class="row py-2">
                                   <div class="col-3">Tanggal Pengajuan Pemusnahan</div>
                                   <div class="col-7">: {{ date('Y-m-d') }}</div>
                               </div>
                               <div class="row py-2">
                                   <div class="col-3">Deskripsi</div>
                                   <div class="col-7">: {{ $pemusnahan->deskripsi }}</div>
                               </div>
                               <div class="row py-2">
                                   <div class="col-3">Status</div>
                                   <div class="col-7">:
                                     @if ($pemusnahan->status_pemusnahan == 'Sudah Disetujui')
                                     <p class="badge badge-success text-white">Sudah Disetujui</p>
                                     @elseif($pemusnahan->status_pemusnahan == 'Proses Pengajuan')
                                     <p class="badge badge-warning text-white">Menunggu Persetujuan Kepala Sekolah
                                     </p>
                                     @elseif($pemusnahan->status_pemusnahan=='Proses Pemusnahan')
                                     <p class="badge badge-danger text-white">Selesaikan Pengisian Data !</p>
                                     @else
                                     <p class="badge badge-outline-success text-success">Sudah Dilaksanakan</p>
                                     @endif
                                 </div>
                             </div>  
                         </div>
                         <div class="col-4">
                             <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($bukti as $index => $value)
                                    <div class="carousel-item @if($index==0) active @endif">
                                      <img src="{{$value->foto}}" class="d-block w-100" alt="...">
                                      <div class="carousel-caption d-none d-md-block">
                                        <h5></h5>
                                        <p>{{$value->created_at}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-3">
                   <table class="table table-bordered table-responsive-sm text-dark">
                       <thead>
                           <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Kode Asset</th>
                            <th>Nama Asset</th>
                            <th>Harga Per Satuan</th>
                            <th>Lokasi Aset</th>
                            <th>Kondisi</th>
                            <th>Tanggal Input</th>
                        </tr>
                    </thead>
                    <tbody>
                       @php $no=1; @endphp
                       @foreach ($asset as $value)
                       <tr>
                        <td>
                            {{$no++}}
                        </td>
                        <td>
                            <img src="{{$value->asset[0]->gambar}}" alt="" class="img-fluid">
                        </td>
                        <td>{{ $value->id_asset }}</td>
                        @foreach ($value->asset as $assets)
                        <td>{{ $assets->nama_asset }}</td>
                        <td>{{ $assets->harga_satuan }}/{{ $assets->satuan }}</td>
                        @foreach ($assets->lokasi as $lokasi)
                        <td>{{ $lokasi->nama_lokasi }}</td>
                        @endforeach
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
