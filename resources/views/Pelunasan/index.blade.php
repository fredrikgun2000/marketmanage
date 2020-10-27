@extends('main')
@section('pelunasan')
<input type="hidden" name="" id="pagination" value="Pelunasan">
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 bgcolor2 ">
			<div class="row">
				<div class="col-lg-12 mt-2 mb-1">
					<h5 class="color1">Pelunasan</h5>
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
							 						<option>{{$d->nama}}</option>
							 						@endforeach
							 					</select>
							 				</div>
							 			</div>
					 				</div>
					 			</div>
							 <div class="row">
							 	<div class="col-lg-12 text-right">
							 		<button id="PostPelunasan" class="bgcolor1 btn text-light">Cari</button>
							 	</div>
							 </div>
			
					 	</div>
					 </div>
					 <div class="row">
					 	<div id="PelunasanLoad" class="col-lg-12"></div>
					 </div>
					 </div>
				</div>
	</div>

					 <div class="row text-right my-2">
					 	<div class="col-lg-12">Total Hutang : Rp <b class="mx-3 rupiah" id="subtotalb"></b><input type="hidden" id="subtotala"></div>
					 	<div class="col-lg-12">Total Pelunasan : Rp <b class="mx-3 rupiah" id="subtotalpb"></b><input type="hidden" id="subtotalpa"></div>
					 	<div class="col-lg-12">Belum Lunas : Rp <b class="mx-3 rupiah text-danger" id="subtotalp2"></b></div>
					 </div>
					
</div>
@endsection