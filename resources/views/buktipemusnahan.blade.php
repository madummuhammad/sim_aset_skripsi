       @extends('main')

       @section('judul_halaman', 'Aset')

       @section('konten')
       <div class="content-body">
         <div class="container-fluid">
             <div class="row page-titles mx-0">
                 <div class="col-sm-9 p-md-0">
                     <div class="welcome-text">
                         <h4>Hi, {{ auth()->user()->nama_user }}!</h4>
                         <span>Halaman ini mengirimkan bukti pelaksanaan pemusnahan! Pastikan bahwa gambar yang akan di upload sudah benar!</span>
                     </div>
                 </div>
                 <div class="col-sm-3 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                     <ol class="breadcrumb">
                         <li class="breadcrumb-item text-capitalize"><a
                             href="{{url('asset/pemusnahan')}}">{{ Request::segment(2) }}</a></li>
                             <li class="breadcrumb-item text-capitalize"><a
                             href="{{url('asset/pemusnahan/')}}/{{Request::segment(4)}}">Detail</a></li>
                             <li class="breadcrumb-item text-capitalize"><a
                             href="javascript:void(0)">{{ Request::segment(3) }}</a></li>
                         </ol>
                     </div>
                 </div>
                 <!-- row -->
                 <div class="row text-dark">
                     <div class="col-12">
                         <div class="card">
                             <div class="card-header">
                                 <h4 class="card-title">Bukti Pemusnahan Asset</h4>
                             </div>
                             <div class="card-body">
                                <div class="row">
                                    <div class="col-8">                                        
                                     <div class="row py-2">
                                         <div class="col-5">ID Pemusnahan</div>
                                         <div class="col-7">: {{ $pemusnahan->id_pemusnahan }}</div>
                                     </div>
                                     <div class="row py-2">
                                         <div class="col-5">Alasan Pemusnahan</div>
                                         <div class="col-7">: {{ $pemusnahan->nama }}</div>
                                     </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-6">
                                    <form method="POST" action="{{url('asset/pemusnahan/bukti')}}" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="input-group">
                                            <input type="text" value="{{Request::segment(4)}}" name="id_pemusnahan" hidden>
                                            <input type="file" class="form-control" name="foto">
                                            <button class="btn btn-primary">Kirim</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive mt-3">
                               <table class="table table-bordered table-responsive-sm text-dark">
                                   <thead>
                                       <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Tanggal Upload</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no=1;
                                    @endphp
                                    @foreach($bukti as $bukti)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td><img src="{{$bukti->foto}}" alt="" class="img-fluid"></td>
                                        <td>{{$bukti->created_at}}</td>
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
