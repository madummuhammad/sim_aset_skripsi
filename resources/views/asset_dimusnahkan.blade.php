       @extends('main')

       @section('judul_halaman', 'Aset')

       @section('konten')
       <div class="content-body">
       	<div class="container-fluid">
       		<div class="row page-titles mx-0">
       			<div class="col-sm-12 p-md-0">
       				<div class="welcome-text">
       					<h4>Hi, {{ auth()->user()->nama_user }}!</h4>
                    <span>Halaman ini digunakan untuk melihat riwayat aset yang sudah dimusnahkan</span>
                 </div>
              </div>
          </div>
          <!-- row -->
          <div class="row">
           <div class="col-12">
             <div class="card">
               <div class="card-header">
                 <h4 class="card-title">Asset Dimusnahkan</strong></u></h4>
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
                         <th>Foto</th>
                      </tr>
                   </thead>
                   <tbody>
                    @php $no=1; @endphp
                    @foreach ($asset as $value)
                    <tr>
                      <td>{{$no++}}</td>
                      <td>{{ $value->id_asset }}</td>
                      <td>{{ $value->nama_asset }}</td>
                      @foreach ($value->lokasi as $lokasi)
                      <td>{{ $lokasi->nama_lokasi }}</td>
                      @endforeach
                      <td>{{ $value->kondisi }}</td>
                      <td>
                       <img src="{{$value->gambar}}" alt="" style="width:100px;height: 100px;">
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
