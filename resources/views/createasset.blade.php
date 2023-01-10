       @extends('main')

       @section('judul_halaman', 'Aset')

       @section('konten')
                                    <div class="content-body">
                                     <div class="container-fluid">
                                         <div class="row page-titles mx-0">
                                             <div class="col-sm-8 p-md-0">
                                                 <div class="welcome-text">
                                                     <h4>Hi, {{ auth()->user()->nama_user }}!</h4>
                                                     <span>Halaman ini digunakan untuk mendata aset yang ada. Cermati kembali data yang diinputkan</span>
                                                 </div>
                                             </div>
                                             <div class="col-sm-4 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                                                 <ol class="breadcrumb">
                                                     <li class="breadcrumb-item active"><a href="{{url('asset')}}">Asset</a></li>
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
                                                                         <input type="text" class="form-control  @error('nama_asset') is-invalid @enderror" placeholder=""name="nama_asset" value="{{old('nama_asset')}}">
                                                                         @error('nama_asset')
                                                                         <div class="invalid-feedback">
                                                                             {{$message}}
                                                                         </div>
                                                                         @enderror
                                                                     </div>
                                                                     <div class="form-group col-md-6">
                                                                         <label>Harga Satuan</label>
                                                                         <input type="number" class="form-control  @error('harga_satuan') is-invalid @enderror" placeholder=""
                                                                         name="harga_satuan" value="{{old('harga_satuan')}}">
                                                                         @error('harga_satuan')
                                                                         <div class="invalid-feedback">
                                                                             {{$message}}
                                                                         </div>
                                                                         @enderror
                                                                     </div>
                                                                     <div class="form-group col-md-6">
                                                                         <label>Kategori Asset</label>
                                                                         <div class="input-group">
                                                                             <select id="inputState" name="id_kategori_asset" class="form-control  @error('id_kategori_asset') is-invalid @enderror">
                                                                                 <option selected value="">Pilih Kategori Asset...</option>
                                                                                 @foreach ($kategori_asset as $value)
                                                                                 <option value="{{ $value->id_kategori_asset }}">
                                                                                     {{ $value->id_kategori_asset }} - {{ $value->nama_kategori }}
                                                                                 </option>
                                                                                 @endforeach
                                                                             </select>
                                                                             <button type="button" data-toggle="modal" data-target="#tambahkategori" class="btn btn-sm btn-primary">+</button>
                                                                         </div>
                                                                         @error('id_kategori_asset')
                                                                         <div class="invalid-feedback">
                                                                           {{$message}}
                                                                       </div>
                                                                       @enderror
                                                                   </div>
                                                                   <div class="form-group col-md-6">
                                                                    <label>Jenis Asset</label>
                                                                    <div class="input-group">
                                                                     <select id="inputState" name="id_jenis_asset" class="form-control  @error('id_jenis_asset') is-invalid @enderror">
                                                                         <option selected value="">Pilih Jenis Asset...</option>
                                                                         @foreach ($jenis_asset as $value)
                                                                         <option value="{{ $value->id_jenis_asset }}">
                                                                             {{ $value->id_jenis_asset }} - {{ $value->nama_jenis }}
                                                                         </option>
                                                                         @endforeach
                                                                     </select>
                                                                     <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahjenis">+</button>
                                                                 </div>
                                                                 @error('id_jenis_asset')
                                                                 <div class="invalid-feedback">
                                                                     {{$message}}
                                                                 </div>
                                                                 @enderror
                                                             </div>
                                                             <div class="form-group col-md-6">
                                                                 <label>Lokasi</label>
                                                                 <select id="inputState" name="kode_lokasi" class="form-control  @error('kode_lokasi') is-invalid @enderror">
                                                                     <option selected value="">Pilih Lokasi...</option>
                                                                     @foreach ($lokasi as $value)
                                                                     <option value="{{ $value->kode_lokasi }}">
                                                                         {{ $value->kode_lokasi }} - {{ $value->nama_lokasi }}
                                                                     </option>
                                                                     @endforeach
                                                                 </select>
                                                                 @error('kode_lokasi')
                                                                 <div class="invalid-feedback">
                                                                   {{$message}}
                                                               </div>
                                                               @enderror
                                                           </div>
                                                           <div class="form-group col-md-6">
                                                             <label>Kondisi</label>
                                                             <select id="inputState" name="kondisi" class="form-control  @error('kondisi') is-invalid @enderror">
                                                                 <option selected value="">Pilih Kondisi...</option>
                                                                 <option value="Sangat Bagus">Sangat Bagus</option>
                                                                 <option value="Bagus">Bagus</option>
                                                                 <option value="Cukup Bagus">Cukup Bagus</option>
                                                                 <option value="Rusak">Rusak</option>
                                                             </select>
                                                             @error('kondisi')
                                                             <div class="invalid-feedback">
                                                                 {{$message}}
                                                             </div>
                                                             @enderror
                                                         </div>
                                                         <div class="form-group col-md-6">
                                                             <label>Satuan</label>
                                                             <input type="text" class="form-control  @error('satuan') is-invalid @enderror" name="satuan"
                                                             placeholder="Contoh: m2, buah, km2"  value="{{old('satuan')}}">
                                                             @error('satuan')
                                                             <div class="invalid-feedback">
                                                               {{$message}}
                                                           </div>
                                                           @enderror
                                                       </div>
                                                       <div class="form-group col-md-6">
                                                         <label>Jumlah</label>
                                                         <input type="number" class="form-control  @error('jumlah') is-invalid @enderror" placeholder="" name="jumlah"  value="{{old('jumlah')}}">
                                                         @error('jumlah')
                                                         <div class="invalid-feedback">
                                                             {{$message}}
                                                         </div>
                                                         @enderror
                                                     </div>
                                                     <div class="form-group col-md-6">
                                                         <label for="">Tanggal Pembelian</label>
                                                         <input type="date" class="form-control" name="tgl_pembelian">
                                                     </div>
                                                     <div class="form-group col-md-6">
                                                         <label>Umur Ekonomis</label>
                                                         <div class="row">
                                                             <div class="col-5">
                                                                <input type="text" name="umur_mulai" class="form-control  @error('umur_mulai') is-invalid @enderror"
                                                                placeholder="{{ date('Y-m-d') }}" id="mdate"
                                                                value="{{ date('Y-m-d') }}">
                                                                @error('umur_mulai')
                                                                <div class="invalid-feedback">
                                                                 {{$message}}
                                                             </div>
                                                             @enderror
                                                         </div>
                                                         <div class="col-2 d-flex align-items-center">
                                                             <label for="">Sampai</label>
                                                         </div>
                                                         <div class="col--5">
                                                            <input type="text" class="form-control  @error('umur_akhir') is-invalid @enderror"
                                                            placeholder="{{ date('Y-m-d') }}" id="mdate2"
                                                            name="umur_akhir" value="{{ date('Y-m-d') }}">
                                                            @error('umur_akhir')
                                                            <div class="invalid-feedback">
                                                             {{$message}}
                                                         </div>
                                                         @enderror
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label>Status</label>
                                                 <input type="text" class="form-control" placeholder=""
                                                 value="Tersedia" readonly>
                                             </div>
                                             <div class="form-group col-md-6">
                                                 <label>Tanggal Input</label>
                                                 <input type="date" class="form-control  @error('tgl_input') is-invalid @enderror" placeholder="" name="tgl_input" value="{{ date('Y-m-d') }}">
                                                 @error('tgl_input')
                                                 <div class="invalid-feedback">
                                                     {{$message}}
                                                 </div>
                                                 @enderror
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
         <div class="modal fade" id="tambahjenis" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <form method="POST" action="{{url('jenis_asset')}}" class="mutasi-form">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Jenis Asset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                @csrf
                @method('post')
                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label>ID Jenis Asset</label>
                        @if($id_jenis_asset==NULL)
                        <input type="text" name="id_jenis" class="form-control" placeholder="" value="{{$id_jenis_asset}}" readonly>
                        @else
                        <input type="text" name="id_jenis" class="form-control" placeholder="" value="{{$id_jenis_asset}}" readonly>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label>Nama Jenis</label>
                        <input type="text" name="nama_jenis" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
        </div>
    </form>
</div>
</div>
<div class="modal fade" id="tambahkategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <form method="POST" action="{{url('kategori')}}" class="mutasi-form">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Kategori</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        @csrf
        @method('post')
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>ID Kategori</label>
                @if($id_kategori==NULL)
                <input type="text" name="id_kategori" class="form-control" placeholder="" value="{{$id_kategori}}" readonly>
                @else
                <input type="text" name="id_kategori" class="form-control" placeholder="" value="{{$id_kategori}}" readonly>
                @endif
            </div>
            <div class="form-group col-md-12">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" placeholder="">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </div>
</div>
</form>
</div>
</div>

@endsection
