       @extends('main')

       @section('judul_halaman','Aset')

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
                            </div>
                        </div>
                        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
                            </ol>
                        </div>
                    </div>
                    <!-- row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Aset</h4>
                                </div>
                                <div class="card-body">
                                    <div class="basic-form">
                                        <form method="POST" action="{{url('asset/show')}}">
                                            @csrf
                                            @method('patch');
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>ID Asset</label>
                                                    <input type="text" class="form-control" placeholder="" name="id_asset" value="{{$asset->id_asset}}" readonly>
                                                </div>
                                                <input type="text" name="id_grup_aset" value="{{Request::segment(3)}}" hidden>
                                                <div class="form-group col-md-6">
                                                    <label>Nama Asset</label>
                                                    <input type="text" class="form-control" placeholder="" name="nama_asset" value="{{$asset->nama_asset}}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Harga Satuan</label>
                                                    <input type="text" class="form-control" placeholder="" name="harga_satuan" value="{{$asset->harga_satuan}}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Jenis Asset</label>
                                                    <select id="inputState" name="id_jenis_asset" class="form-control">
                                                        <option selected value="">Pilih Jenis Asset...</option>
                                                        @foreach($jenis_asset as $value)
                                                        <option value="{{$value->id_jenis_asset}}" @if($asset->id_jenis_asset==$value->id_jenis_asset) {{'selected'}} @endif>{{$value->id_jenis_asset}} - {{$value->nama_jenis}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Kategori Asset</label>
                                                    <select id="inputState" name="id_kategori_asset" class="form-control">
                                                        <option selected value="">Pilih Kategori Asset...</option>
                                                        @foreach($kategori_asset as $value)
                                                        <option value="{{$value->id_kategori_asset}}" @if($asset->id_kategori_asset==$value->id_kategori_asset) {{'selected'}} @endif>{{$value->id_kategori_asset}} - {{$value->nama_kategori}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Lokasi</label>
                                                    <select id="inputState" name="kode_lokasi" class="form-control">
                                                        <option selected value="">Pilih Lokasi...</option>
                                                        @foreach($lokasi as $value)
                                                        <option value="{{$value->kode_lokasi}}" @if($asset->kode_lokasi==$value->kode_lokasi) {{'selected'}} @endif>{{$value->kode_lokasi}} - {{$value->nama_lokasi}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Kondisi</label>
                                                    <select id="inputState" name="kondisi" class="form-control">
                                                        <option value="">Pilih Kondisi...</option>
                                                        
                                                        <option value="Sangat Bagus" @if($asset->kondisi=='Sangat Bagus') {{'selected'}} @endif>Sangat Bagus</option>
                                                        
                                                        <option value="Bagus" @if($asset->kondisi=='Bagus') {{'selected'}} @endif>Bagus</option>
                                                        <option value="Cukup Bagus" @if($asset->kondisi=='Cukup Bagus') {{'selected'}} @endif>Cukup Bagus</option>
                                                        <option value="Buruk" @if($asset->kondisi=='Buruk') {{'selected'}} @endif>Buruk</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Satuan</label>
                                                    <input type="text" class="form-control" name="satuan" placeholder="Contoh: m2, buah, km2" value="{{$asset->satuan}}">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </form>
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