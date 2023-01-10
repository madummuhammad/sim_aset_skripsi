       @extends('main')

       @section('judul_halaman', 'Aset')

       @section('konten')
       <div class="content-body">
           <div class="container-fluid">
               <div class="row page-titles mx-0">
                   <div class="col-sm-6 p-md-0">
                       <div class="welcome-text">
                           <h4>Hi, {{ auth()->user()->nama_user }}!</h4>
                           <span>Halaman ini digunakan untuk melihat dan mengunduh laporna aset</span>
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
