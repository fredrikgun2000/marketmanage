@extends('main')
@section('laporan')
<input type="hidden" name="" id="pagination" value="Laporan">
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 bgcolor2 ">
					<div class="row">
						<div class="col-lg-12 mt-2 mb-1">
								<h5 class="color1">Laporan</h5>
								<ul>
									<li class="d-inline mx-1 text-success laporan" id="subpembelian">Pembelian</li>
									<li class="d-inline mx-1 text-success laporan" id="subpenjualan">Penjualan</li>
									<li class="d-inline mx-1 text-success laporan" id="subhutang">Hutang</li>
									<li class="d-inline mx-1 text-success laporan" id="subabsen">Staff</li>
									
								</ul>
						</div>
					</div>
					 <div id="subpembelianf">
					 	
					  <div class="row" >
					 	<div class="col-lg-12 my-2">
					 			<div class="row">
					 				<div class="col-lg-6">
							 			<div class="row">
							 				<div class="col-lg-4">
							 					<label>tanggal transaksi</label>
							 				</div>
							 				<div class="col-lg-8">
							 					<input name="tanggal1" id="tanggal1">
							 					<input name="tanggal2" id="tanggal2">
							 				</div>
							 			</div>
					 				</div>
					 				<div class="col-lg-6">
							 			<div class="row">
							 				<div class="col-lg-4">
							 					<label>kode barang</label>
							 				</div>
							 				<div class="col-lg-6">
							 					<input type="text" name="kode" id="kode" value="">
							 				</div>
							 			</div>
					 				</div>
					 				<div class="col-lg-6">
							 			<div class="row">
							 				<div class="col-lg-4">
							 					<label>Nama Supplier</label>
							 				</div>
							 				<div class="col-lg-6">
							 					<select id="supplier">
							 						<option></option>
							 						@foreach($datasupplier as $d)
							 						<option>{{$d->nama}}-{{$d->telepon}}</option>
							 						@endforeach
							 					</select>
							 				</div>
							 			</div>
					 				</div>
					 				<div class="col-lg-6">
							 			<div class="row">
							 				<div class="col-lg-4">
							 					<label>Transaksi</label>
							 				</div>
							 				<div class="col-lg-6">
							 					<input type="number" name="transaksi" id="transaksill" value="">
							 				</div>
							 			</div>
					 				</div>
					 			</div>
							 <div class="row">
							 	<div class="col-lg-12 text-right">
							 		<button id="PostLaporanPembelian" class="bgcolor1 btn text-light">Cari</button>
							 	</div>
							 </div>
			
					 	</div>
					 </div>
					 <div class="row">
					 	<div id="LaporanPembelianLoad" class="col-lg-12"></div>
					 </div>
					 <div>
					 	<div class="row text-right my-2">
					 	<div class="col-lg-12">Total Pembelian :<b class="mx-3 rupiah" id="subtotalb"></b></div>
					 </div>
					 </div>
					 </div>


					 <div id="subpenjualanf" style="display: none;">
					 	
					  <div class="row" >
					 	<div class="col-lg-12 my-2">
					 			<div class="row">
					 				<div class="col-lg-6">
							 			<div class="row">
							 				<div class="col-lg-4">
							 					<label>tanggal transaksi</label>
							 				</div>
							 				<div class="col-lg-8">
							 					<input name="tanggal1" id="tanggal1j">
							 					<input name="tanggal2" id="tanggal2j">
							 				</div>
							 			</div>
					 				</div>
					 				<div class="col-lg-6">
							 			<div class="row">
							 				<div class="col-lg-4">
							 					<label>kode barang</label>
							 				</div>
							 				<div class="col-lg-6">
							 					<input type="text" name="kode" id="kodej" value="">
							 				</div>
							 			</div>
					 				</div>
					 				<div class="col-lg-6">
							 			<div class="row">
							 				<div class="col-lg-4">
							 					<label>Transaksi</label>
							 				</div>
							 				<div class="col-lg-6">
							 					<input type="number" name="transaksi" id="transaksilp" value="">
							 				</div>
							 			</div>
					 				</div>
					 			</div>
							 <div class="row">
							 	<div class="col-lg-12 text-right">
							 		<button id="PostLaporanPenjualan" class="bgcolor1 btn text-light">Cari</button>
							 	</div>
							 </div>
			
					 	</div>
					 </div>
					 <div class="row">
					 	<div id="LaporanPenjualanLoad" class="col-lg-12"></div>
					 </div>
					 <div>
					 	<div class="row text-right my-2">
					 	<div class="col-lg-12">Total Penjualan :<b class="mx-3" id="subtotaljualb"></b></div>
					 </div>
					 </div>
					 </div>



					 	<div id="subhutangf" style="display: none;">
					 	
					  <div class="row" >
					 	<div class="col-lg-12 my-2">
					 			<div class="row">
					 				<div class="col-lg-6">
							 			<div class="row">
							 				<div class="col-lg-4">
							 					<label>tanggal transaksi</label>
							 				</div>
							 				<div class="col-lg-8">
							 					<input name="tanggal1h" id="tanggal1h">
							 					<input name="tanggal2h" id="tanggal2h">
							 				</div>
							 			</div>
					 				</div>
					 				<div class="col-lg-6">
							 			<div class="row">
							 				<div class="col-lg-4">
							 					<label>Transaksi</label>
							 				</div>
							 				<div class="col-lg-6">
							 					<input type="number" name="transaksi" id="transaksi" value="">
							 				</div>
							 			</div>
					 				</div>
					 			</div>
					 			<div class="row my-2">
					 				<div class="col-lg-6">
							 			<div class="row">
							 				<div class="col-lg-4">
							 					<label>Jatuh Tempo</label>
							 				</div>
							 				<div class="col-lg-8">
							 					<input name="tanggal3" id="tanggal3">
							 					<input name="tanggal4" id="tanggal4">
							 				</div>
							 			</div>
					 				</div>
					 				<div class="col-lg-6">
							 			<div class="row">
							 				<div class="col-lg-4">
							 					<label>supplier</label>
							 				</div>
							 				<div class="col-lg-6">
							 					<select name="supplier" id="supplier">
							 						<option></option>
							 						@foreach($datasupplier as $d)
							 						<option>{{$d->nama}}-{{$d->telepon}}</option>
							 						@endforeach
							 					</select>
							 				</div>
							 			</div>
					 				</div>
					 			</div>
							 <div class="row">
							 	<div class="col-lg-12 text-right">
							 		<button id="PostHutang" class="bgcolor1 btn text-light">Cari</button>
							 	</div>
							 </div>
			
					 	</div>
					 </div>
					 <div class="row">
					 	<div id="HutangLoad" class="col-lg-12"></div>
					 </div>
					 </div>

					 	<div id="tampilabsen" style="display: none;">
	<div class="row bgcolor2 my-2">
		<div class="col-lg-12">
			<div class="row" >
				 	<div class="col-lg-12 my-2">
				 			<div class="row">
				 				<div class="col-lg-6">
						 			<div class="row">
						 				<div class="col-lg-4">
						 					<label>tanggal </label>
						 				</div>
						 				<div class="col-lg-8">
						 					<input name="tanggal1" id="tanggal1s">
						 					<input name="tanggal2" id="tanggal2s">
						 				</div>
						 			</div>
				 				</div>
				 				
				 				<div class="col-lg-6">
						 			<div class="row">
						 				<div class="col-lg-4">
						 					<label>Staff</label>
						 				</div>
						 				<div class="col-lg-6">
						 					<select id="staff">
						 						<option></option>
						 						@foreach($datapenjual as $d)
						 						<option>{{$d->namapengguna}}</option>
						 						@endforeach
						 					</select>
						 				</div>
						 			</div>
				 				</div>
				 				<div class="col-lg-6">
						 			<div class="row">
						 				<div class="col-lg-4">
						 					<label>Pengabsen</label>
						 				</div>
						 				<div class="col-lg-6">
						 					<select id="admin">
						 						<option></option>
						 						@foreach($dataadmin as $d)
						 						<option>{{$d->namapengguna}}</option>
						 						@endforeach
						 					</select>
						 				</div>
						 			</div>
				 				</div>
				 			</div>
						 <div class="row">
						 	<div class="col-lg-12 text-right">
						 		<button id="PostLaporanAbsen" class="bgcolor1 btn text-light">Cari</button>
						 	</div>
						 </div>
		
				 	</div>
				 </div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12" id="LaporanAbsenLoad">
		</div>
	</div>
	</div>

	<div id="tampiluntung" style="display: none;">
	<div class="row bgcolor2 my-2">
		<div class="col-lg-12">
			<div class="row" >
				 	<div class="col-lg-12 my-2">
				 			<div class="row">
				 				<div class="col-lg-6">
						 			<div class="row">
						 				<div class="col-lg-4">
						 					<label>tanggal </label>
						 				</div>
						 				<div class="col-lg-8">
						 					<input name="tanggal1" id="tanggal1un">
						 					<input name="tanggal2" id="tanggal2un">
						 				</div>
						 			</div>
				 				</div>
				 			</div>
						 <div class="row">
						 	<div class="col-lg-12 text-right">
						 		<button id="PostLaporanUntung" class="bgcolor1 btn text-light">Cari</button>
						 	</div>
						 </div>
		
				 	</div>
				 </div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12" id="LaporanUntungLoad">
		</div>
	</div>
	</div>
				</div>
	</div>
					
</div>
@endsection