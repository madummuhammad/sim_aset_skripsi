       @extends('main')

       @section('judul_halaman','Mutasi')

       @section('konten')
        <!--**********************************
            Content body start
            ***********************************-->
            <div class="content-body">
                <div class="container-fluid">
                    <div class="row page-titles mx-0">
                        <div class="col-sm-6 p-md-0">
                            <div class="welcome-text">
                                <h4>Hi, {{auth()->user()->nama_user}}!</h4>
                                <span class="ml-1">Datatable</span>
                            </div>
                        </div>
                        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-capitalize"><a href="javascript:void(0)">{{Request::segment(1)}}</a></li>
                            </ol>
                        </div>
                    </div>
                    <!-- row -->
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
                                                @foreach($mutasi as $value)
                                                @php $no++ @endphp
                                                <tr>
                                                    <td>{{$no}}</td>
                                                    <td>{{$value->id_mutasi}}</td>
                                                    <td>{{$value->nama}}</td>
                                                    <td>{{$value->nama_lokasi}}</td>
                                                    <td>{{$value->deskripsi}}</td>
                                                    <td>
                                                        @if($value->status_mutasi==2)
                                                        <p class="badge badge-success text-white">Sudah Disetujui</p>
                                                        @elseif($value->status_mutasi==1)
                                                        <p class="badge badge-warning text-white">Menunggu Persetujuan Kepala Sekolah</p>
                                                        @else
                                                        <p class="badge badge-danger text-white">Selesaikan Pengisian Data !</p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{url('asset/mutasi/')}}/{{$value->id_mutasi}}" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
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
        <!--**********************************
            Content body end
            ***********************************-->

            @endsection