 @extends('main')

 @section('judul_halaman','Dashboard')

 @section('konten')
        <!--**********************************
            Content body start
            ***********************************-->
            <div class="content-body">
                <div class="container-fluid">
                    <div class="row page-titles mx-0">
                        <div class="col-sm-6 p-md-0">
                            <div class="welcome-text">
                                <h4>Selamat Datang, {{auth()->user()->nama}}</h4>
                                <p class="mb-0">Kelola Asetmu</p>
                            </div>
                        </div>
                        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Layout</a></li>
                                <li class="breadcrumb-item active"><a href="javascript:void(0)">Blank</a></li>
                            </ol>
                        </div>
                    </div>

                    <div class="row">
                      <div class="col-xl-12 col-lg-12 col-xxl-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Notice Board</h4>
                            </div>
                            <div class="card-body">
                                <div class="recent-comment m-t-15">
                                    @foreach($notifikasi as $value)
                                    <?php if (auth()->user()->id_hak_akses==3 AND $value->jenis_notifikasi=='Pengajuan Mutasi' OR $value->jenis_notifikasi=='Pengajuan Pemusnahan'): ?>
                                    <div class="media p-2 @if($value->read_at==NULL) {{'font-weight-bold bg-light shadow'}} @endif">
                                        <!-- <div class="media-left">
                                            <a href="#"><img class="media-object mr-3" src="./images/avatar/4.png" alt="..."></a>
                                        </div> -->
                                        <div class="media-body">
                                            <form action="{{url('notifikasi')}}" method="POST">
                                                @method('patch')
                                                @csrf
                                                <input type="text" name="id_notifikasi" value="{{$value->id}}" hidden>
                                                <button class="btn btn-custom" type="submit">
                                                    <h4 class="media-heading text-left">{{$value->id_asset}}</h4>
                                                    <p class="text-left @if($value->read_at==NULL) {{'font-weight-bold text-dark'}} @endif">{{$value->keterangan}}</p>
                                                </button>
                                                 <div class="comment-date">
                                                    <p>{{date('H:i',strtotime($value->created_at))}}</p>
                                                    <p class="font-weight-bold">{{date('d:m:Y',strtotime($value->created_at))}}</p>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @elseif(auth()->user()->id_hak_akses==1 AND $value->jenis_notifikasi=='Pengecekan Kondisi' OR $value->jenis_notifikasi=='Persetujuan Mutasi' OR $value->jenis_notifikasi=='Persetujuan Pemusnahan')
                                    <div class="media p-2 @if($value->read_at==NULL) {{'font-weight-bold bg-light shadow'}} @endif">
                                        <!-- <div class="media-left">
                                            <a href="#"><img class="media-object mr-3" src="./images/avatar/4.png" alt="..."></a>
                                        </div> -->
                                        <div class="media-body">
                                            <form action="{{url('notifikasi')}}" method="POST">
                                                @method('patch')
                                                @csrf
                                                <input type="text" name="id_notifikasi" value="{{$value->id}}" hidden>
                                                <button class="btn btn-custom" type="submit">
                                                    <h4 class="media-heading text-left">{{$value->id_asset}}</h4>
                                                    <p class="text-left @if($value->read_at==NULL) {{'font-weight-bold text-dark'}} @endif">{{$value->keterangan}}</p>
                                                </button>
                                                <div class="comment-date">
                                                    <p>{{date('H:i',strtotime($value->created_at))}}</p>
                                                    <p class="font-weight-bold">{{date('d:m:Y',strtotime($value->created_at))}}</p>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @elseif(auth()->user()->id_hak_akses==2 AND $value->jenis_notifikasi=='Pengecekan Kondisi' OR $value->jenis_notifikasi=='Persetujuan Mutasi' OR $value->jenis_notifikasi=='Persetujuan Pemusnahan')
                                    <div class="media p-2 @if($value->read_at==NULL) {{'font-weight-bold bg-light shadow'}} @endif">
                                        <!-- <div class="media-left">
                                            <a href="#"><img class="media-object mr-3" src="./images/avatar/4.png" alt="..."></a>
                                        </div> -->
                                        <div class="media-body">
                                            <form action="{{url('notifikasi')}}" method="POST">
                                                @method('patch')
                                                @csrf
                                                <input type="text" name="id_notifikasi" value="{{$value->id}}" hidden>
                                                <button class="btn btn-custom" type="submit">
                                                    <h4 class="media-heading text-left">{{$value->id_asset}}</h4>
                                                    <p class="text-left @if($value->read_at==NULL) {{'font-weight-bold text-dark'}} @endif">{{$value->keterangan}}</p>
                                                </button>
                                                 <div class="comment-date">
                                                    <p>{{date('H:i',strtotime($value->created_at))}}</p>
                                                    <p class="font-weight-bold">{{date('d:m:Y',strtotime($value->created_at))}}</p>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
            ***********************************-->

            @endsection