       @extends('main')

       @section('judul_halaman', 'Aset')

       @section('konten')
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

       				</ol>
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
       										<th>
       											<input type="checkbox" class="main-checkbox">
       										</th>
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
       										<td>
       											@if ($value->status_aset == 'Proses Mutasi')
       											<a href="{{ url('asset/mutasi/') }}/{{ DB::table('transaksi_mutasi')->where('id_asset', $value->id_asset)->orderBy('id_mutasi', 'DESC')->first()->id_mutasi }}"
       												class="badge badge-warning text-white">Proses Mutasi</a>
       												@elseif ($value->status_aset == 'Proses Pemusnahan')
       												<a href="{{ url('asset/pemusnahan/') }}/{{ DB::table('transaksi_pemusnahan')->where('id_asset', $value->id_asset)->orderBy('id_pemusnahan', 'DESC')->first()->id_pemusnahan }}"
       													class="badge badge-warning text-white">Proses
       												Pemusnahan</a>
       												@else
       												<input type="checkbox" class="asset-check"
       												value="{{ $value->id_asset }}"
       												data-lokasi="{{ $value->kode_lokasi }}">
       												{{ $value->status_asset }}
       												@endif
       											</td>
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
