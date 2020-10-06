@extends('main')
@section('scanning')
<input type="hidden" name="" id="pagination" value="Scanning">
@if(session()->has('message'))
    <div class="alert alert-danger">
        {{ session()->get('message') }}
    </div>
@endif
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 bgcolor2">
			<div class="row">
				<div class="col-lg-12 mt-2 mb-1">
					<h5 class="color1">Penjualan</h5>
				</div>
			</div>
			<div class="row">
					<div class="col-lg-6">
		 			<form id="PelangganPost" method="Post">
			 			<div class="row">
			 				<div class="col-lg-4">
			 					<label>Kode</label>
			 				</div>
			 				<div class="col-lg-5">
			 					<input type="text" id="kode2">
			 				</div>
			 				<div class="col-lg-3">
			 					<button class="btn bg-success text-light" id="scanbut" type="button" style="display: none;">Scan</button>
			 					<button class="btn bgcolor1 text-light" id="CartManualPost" type="button">post</button>
			 				</div>
			 			</div>
		 			</form>
					</div>
				</div>
			</div>
		</div>
		<form action="/PenjualanPost" method="POST">
			@csrf
		<div class="row mb-2 bgcolor2">
			<div class="col-lg-6">
			 			<div class="row">
			 				<div class="col-lg-4">
			 					<label>tanggal transaksi</label>
			 				</div>
			 				<div class="col-lg-8">
			 					<input type="text" id="tanggal1" name="tanggalpost" value="<?php echo date('Y-m-d'); ?>">
			 				</div>
			 			</div>

						</div>
				</div>
		<div class="row">
			<div class="col-lg-12" id="CartLoad"></div>
		</div>
		<div class="row my-2">
			<div class="col-lg-6">
				<div class="row">
					
				</div>
				
				<div class="row">
					<div class="col-lg-7">Subtotal</div>
					<div class="col-lg-5 rupiah" id="subtotalb">
					</div>
						<input type="hidden" id="subtotala" name="subtotalt">
				</div>
				<div class="row my-2">
					<div class="col-lg-7">Discount %</div>
					<div class="col-lg-5"><input type="number" min="0" name="disc1t" value="0" id="disc3k" ></div>
				</div>
				<div class="row my-2">
					<div class="col-lg-7">Discount Nom</div>
					<div class="col-lg-5"><input type="number" min="0" name="discnominalt" value="0" id="discnominal2" ></div>
				</div>
				<div class="row my-2">
					<div class="col-lg-7">Grand Total</div>
					<div class="col-lg-5" id="grandtotal2"></div>
					<input type="hidden" name="grandtotal" id="grandtotal">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="row my-2">
					<div class="col-lg-7">Tunai</div>
					<div class="col-lg-5"><input type="number" min="0" name="tunai" value="0" id="tunai"></div>
				</div>
				<div class="row my-2">
					<div class="col-lg-7">Debit</div>
					<div class="col-lg-5"><input type="number" min="0" name="debit" value="0" id="debit"></div>
				</div>
				<div class="row my-2">
					<div class="col-lg-7">E-Money</div>
					<div class="col-lg-5"><input type="number" min="0" name="money" value="0" id="money"></div>
				</div>
				<div class="row my-2">
					<div class="col-lg-7">Kembalian </div>
					<div class="col-lg-5 text-success" id="kembalian">0</div>
				</div>
				<div class="row my-2">
					<div class="col-lg-7"><button type="submit" class="btn text-light bgcolor1">Post Transaksi</button></div>
				</div>
			</div>
		</div>
		</form>
</div>
<input type="text" id="kodex" style="opacity: 0;">
@endsection