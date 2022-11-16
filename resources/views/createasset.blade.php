       @extends('main')

       @section('judul_halaman', 'Aset')

       @section('konten')
           <!--**********************************
                                    Content body start
                                    ***********************************-->
           <div class="content-body">
               <div class="container-fluid">
                   <div class="row page-titles mx-0">
                       <div class="col-sm-6 p-md-0">
                           <div class="welcome-text">
                               <h4>Hi, {{ auth()->user()->nama_user }}!</h4>
                           </div>
                       </div>
                       <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                           <ol class="breadcrumb">
                               <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah</a></li>
                           </ol>
                       </div>
                   </div>
                   <!-- row -->
                   <div class="row">
                       <div class="col-12">
                           <div class="card">
                               <div class="card-header">
                                   <h4 class="card-title">Tambah Aset</h4>
                               </div>
                               <div class="card-body">
                                   <div class="basic-form">
                                       <form method="POST" action="{{ url('asset/create') }}">
                                           @csrf
                                           @method('post')
                                           <div class="form-row">
                                               <div class="form-group col-md-6">
                                                   <label>Nama Aset</label>
                                                   <input type="text" class="form-control" placeholder=""
                                                       name="nama_asset">
                                               </div>
                                               <div class="form-group col-md-6">
                                                   <label>Harga Satuan</label>
                                                   <input type="text" class="form-control" placeholder=""
                                                       name="harga_satuan">
                                               </div>
                                               <div class="form-group col-md-6">
                                                   <label>Kategori Asset</label>
                                                   <select id="inputState" name="id_kategori_asset" class="form-control">
                                                       <option selected value="">Pilih Kategori Asset...</option>
                                                       @foreach ($kategori_asset as $value)
                                                           <option value="{{ $value->id_kategori_asset }}">
                                                               {{ $value->id_kategori_asset }} - {{ $value->nama_kategori }}
                                                           </option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                               <div class="form-group col-md-6">
                                                   <label>Jenis Asset</label>
                                                   <select id="inputState" name="id_jenis_asset" class="form-control">
                                                       <option selected value="">Pilih Jenis Asset...</option>
                                                       @foreach ($jenis_asset as $value)
                                                           <option value="{{ $value->id_jenis_asset }}">
                                                               {{ $value->id_jenis_asset }} - {{ $value->nama_jenis }}
                                                           </option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                               <div class="form-group col-md-6">
                                                   <label>Lokasi</label>
                                                   <select id="inputState" name="kode_lokasi" class="form-control">
                                                       <option selected value="">Pilih Lokasi...</option>
                                                       @foreach ($lokasi as $value)
                                                           <option value="{{ $value->kode_lokasi }}">
                                                               {{ $value->kode_lokasi }} - {{ $value->nama_lokasi }}
                                                           </option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                               <div class="form-group col-md-6">
                                                   <label>Kondisi</label>
                                                   <select id="inputState" name="kondisi" class="form-control">
                                                       <option selected value="">Pilih Kondisi...</option>
                                                       <option value="Sangat Bagus">Sangat Bagus</option>
                                                       <option value="Bagus">Bagus</option>
                                                       <option value="Cukup Bagus">Cukup Bagus</option>
                                                       <option value="Buruk">Buruk</option>
                                                   </select>
                                               </div>
                                               <div class="form-group col-md-6">
                                                   <label>Satuan</label>
                                                   <input type="text" class="form-control" name="satuan"
                                                       placeholder="Contoh: m2, buah, km2">
                                               </div>
                                               <div class="form-group col-md-6">
                                                   <label>Jumlah</label>
                                                   <input type="text" class="form-control" placeholder="" name="jumlah">
                                               </div>
                                               <div class="form-group col-md-6">
                                                   <label>Umur Ekonomis</label>
                                                   <div class="row">
                                                       <div class="col-5">
                                                           <input type="text" name="umur_mulai" class="form-control"
                                                               placeholder="{{ date('Y-m-d') }}" id="mdate"
                                                               value="{{ date('Y-m-d') }}">
                                                       </div>
                                                       <div class="col-2 d-flex align-items-center">
                                                           <label for="">Sampai</label>
                                                       </div>
                                                       <div class="col--5">
                                                           <input type="text" class="form-control"
                                                               placeholder="{{ date('Y-m-d') }}" id="mdate2"
                                                               name="umur_akhir" value="{{ date('Y-m-d') }}">
                                                       </div>
                                                   </div>
                                               </div>
                                               <div class="form-group col-md-6">
                                                   <label>Status</label>
                                                   <input type="text" class="form-control" placeholder="" name="s"
                                                       value="Tersedia">
                                               </div>
                                               <div class="form-group col-md-6">
                                                   <label>Tanggal Input</label>
                                                   <input type="date" class="form-control" placeholder="" name="d"
                                                       value="Tersedia">
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
