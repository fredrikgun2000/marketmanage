@extends('main')
@section('karyawan')
<input type="hidden" id="pagination" value="Karyawan">
<div class="container-fluid">
	<div class="row">
		<div class="" id="alert">
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 mt-2 mb-1">
				<h5 class="color1">Staff</h5>
				<ul>
					<li class="d-inline mx-1 text-success staff" id="subabsen">Absen</li>
					<li class="d-inline mx-1 text-success staff" id="substaffbaru">Tambah Staff</li>
				</ul>
		</div>
	</div>
	<div id="tampilabsen">
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
						 					<input name="tanggal1" id="tanggal1" value="<?php echo date('Y-m-d'); ?>">
						 				</div>
						 			</div>
				 				</div>
				 				<div class="col-lg-6">
						 			<div class="row">
						 				<div class="col-lg-4">
						 					<label>Jam Hadir</label>
						 				</div>
						 				<div class="col-lg-6">
						 					<input type="text" name="jam" id="jam" value="">
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
						 						@foreach($datastaff as $d)
						 						<option>{{$d->namapengguna}}</option>
						 						@endforeach
						 					</select>
						 				</div>
						 			</div>
				 				</div>
				 			</div>
						 <div class="row">
						 	<div class="col-lg-12 text-right">
						 		<button id="PostAbsen" class="bgcolor1 btn text-light">Kirim</button>
						 	</div>
						 </div>
		
				 	</div>
				 </div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12" id="AbsenLoad">
		</div>
	</div>
	</div>
	<div id="tampiltambahstaff" style="display: none;">
	<div class="row bgcolor2 my-2">
		<div class="col-lg-12">
				<form method="POST" id="KaryawanForm">
				@csrf
				<div class="row my-2">
					<div class="col-lg-12">
						Nama Karyawan
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<input type="text" name="namapengguna" id="namapengguna" class="form-control">
					</div>
				</div>
				<div class="row my-2">
					<div class="col-lg-12">
						Kata Sandi
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<input type="password" name="katasandi" id="katasandi" class="form-control">
					</div>
				</div>
				 @if ($message = Session::get('messagesandi'))
				    <div class="alert alert-danger">
				        {{ $message }}
				    </div>
				@endif
				<div class="row my-2">
					<div class="col-lg-12">
						Posisi
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<select name="posisi">
							<option>karyawan</option>
							<option>admin</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<button type="submit" class="btn bgcolor1 text-light my-2">Kirim</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row my-2">
		<div class="col-lg-4">
			<input type="text" class="form-control search"  name="" id="" placeholder="Cari..">
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12" id="KaryawanLoad">
		</div>
	</div>
	</div>
</div>
@endsection