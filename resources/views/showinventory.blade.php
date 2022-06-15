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
                                <h4>Hi, {{auth()->user()->nama}}!</h4>
                            </div>
                        </div>
                        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item text-capitalize"><a href="javascript:void(0)">{{Request::segment(1)}}</a></li>
                                <li class="breadcrumb-item"><a href="{{url(Request::segment(1))}}/{{Request::segment(3)}}">{{$nama_grup->nama_grup}}</a></li>
                                <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
                            </ol>
                        </div>
                    </div>
                    <!-- row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Aset {{$nama_grup->nama_grup}}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="basic-form">
                                        <form method="POST" action="{{url('inventory/show')}}">
                                            @csrf
                                            @method('patch');
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Kode Property {{$nama_grup->nama_grup}}</label>
                                                    <input type="text" class="form-control" placeholder="" name="kode_inventory" value="{{$inventory->kode_inventory}}">
                                                </div>
                                                <input type="text" name="id_grup_aset" value="{{Request::segment(3)}}" hidden>
                                                <div class="form-group col-md-6">
                                                    <label>Nama Property {{$nama_grup->nama_grup}}</label>
                                                    <input type="text" class="form-control" placeholder="" name="nama_inventory" value="{{$inventory->nama_inventory}}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Harga Satuan</label>
                                                    <input type="text" class="form-control" placeholder="" name="harga_satuan" value="{{$inventory->harga_satuan}}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Lokasi</label>
                                                    <select id="inputState" name="lokasi" class="form-control">
                                                        <option value="">Pilih Lokasi...</option>
                                                        @foreach($lokasi as $lokasi)
                                                        <option value="{{$lokasi->kode_property}}" @if($inventory->kode_inventory) selected @endif>{{$lokasi->kode_property}} - {{$lokasi->nama_property}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Kondisi</label>
                                                    <select id="inputState" name="kondisi" class="form-control">
                                                        <option value="">Pilih Kondisi...</option>
                                                        
                                                        <option value="Sangat Bagus" @if($inventory->kondisi=='Sangat Bagus') {{'selected'}} @endif>Sangat Bagus</option>
                                                        
                                                        <option value="Bagus" @if($inventory->kondisi=='Bagus') {{'selected'}} @endif>Bagus</option>
                                                        <option value="Cukup Bagus" @if($inventory->kondisi=='Cukup Bagus') {{'selected'}} @endif>Cukup Bagus</option>
                                                        <option value="Buruk" @if($inventory->kondisi=='Buruk') {{'selected'}} @endif>Buruk</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Satuan</label>
                                                    <input type="text" class="form-control" name="satuan" placeholder="Contoh: m2, buah, km2" value="{{$inventory->satuan}}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Keterangan</label>
                                                    <textarea class="form-control" rows="4" id="comment" name="keterangan">{{$inventory->keterangan}}</textarea>
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