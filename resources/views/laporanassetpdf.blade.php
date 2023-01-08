<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laporan Aset</title>
</head>
<body>
	<style>
		body {
			margin: 0;
			font-family: "Roboto", serif;
			font-size: 0.875rem;
			font-weight: 400;
			line-height: 1.5;
			text-align: left;
		}

		table {
			border-collapse: collapse;
			margin-bottom: 1rem;
			padding-right: 15px;
			padding-left: 15px;
		}

		.table {
			width: 100%;
		}

		.table th,
		.table td {
			padding: 0.2rem;
			vertical-align: top;
			border: 1px solid #000000;
		}

		.table thead th {
			vertical-align: bottom;
			border: 2px solid #000000;
		}

		.kop-surat {
			width: 100%;
			align-items: center;
		}

		.kop {
			line-height: 10px;
			text-align: center;
			margin-left: 12%;
		}

		.kop .alamat p {
			line-height: 4px !important;
			margin-top: -4px;
		}

		.logo {
			position: absolute;
		}

		.logo img {
			width: 100px;
		}

		.fs-60px {
			font-size: 23px;
		}

		.line {
			width: 100%;
		}

		.w-100 {
			width: 100%;
		}

		.tanda-tangan {
			margin-right: 0;
			width: 100%;
		}

		.ttd {
			right: 10px;
			position: absolute;
			text-align: center;
			height: 100px;
		}

		.ttd_grup {
			position: absolute;
		}

		.ttd_img {
			width: 200px;
			margin: 10px;
			position: absolute;
		}

		table{
			width: 100%;
		}

		table tr th{
			border: 1px solid black;
		}

		table tr td{
			border: 1px solid black;
		}
	</style>

	<div class="kop-surat">
		<div class="logo">
			<img src="{{ public_path('assets\images\logo_mts.png') }}" alt="">
		</div>
		<div class="kop">
			<h2>YAYASAN AT - TAQWA JATINGARANG</h2>
			<h1 class="fs-60px">MADRASAH TSANAWIYAH (MTs) AT-TAQWA</h1>
			<h2>TERAKREDITASI A</h2>
			<div class="alamat">
				<p>Alamat : Jl. Bodeh-Watukumpul Jatingarang Bodeh Pemalang</p>
				<p>52365 +6287830584333 E-mail : mtsattaqwa2005@gmail.com</p>
			</div>
		</div>
		<img class="line" src="{{ public_path('assets\images\line.png') }}" alt="">
		<p style="text-align: center; font-weight:bold; text-decoration:underline">Laporan Aset</p>
		<p style="text-align: center; font-weight:bold;">{{$tanggal}}</p>
	</div>
	<table>
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
</body>
</html>