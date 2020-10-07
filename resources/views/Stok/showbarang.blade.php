<div id="subbarang">
<div class="remove">
	<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<a  data-toggle="collapse" href="#JenisForm" role="button" aria-expanded="false" aria-controls="collapseExample">
				    Tambah Katagori
				  </a>
				</div>
			</div>
		</div>
		<div class="container-fluid" >
			<div class="row">
				<div class="" id="alert">
				</div>
			</div>
			<div class="row bgcolor2">
				<div class="col-lg-12">
					<form method="POST" id="JenisForm" action="/JenisFormPost" class="collapse" >
						@csrf
						<div class="row my-2">
							<div class="col-lg-12">
								Jenis Baju
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<input type="text" name="jenis" id="jenis" class="kosong form-control">
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
			    <div class="alert alert-danger" id="stokalert" style="display: none;">
		      </div>
			<div class="row bgcolor2 my-2 py-2">
				<div class="col-lg-12">
						<form method="POST" id="StokForm">
						@csrf
						<div class="row my-1">
							<div class="col-lg-6">
								<div class="row">
									<div class="col-lg-4">Kode Barang</div>
									<div class="col-lg-8"><input type="text" name="kode" class="kosong form-control"></div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="row">
									<div class="col-lg-4">Nama Barang</div>
									<div class="col-lg-8"><input type="text" name="nama" class="kosong form-control"></div>
								</div>
							</div>
						</div>
						<div class="row my-1">
							<div class="col-lg-6">
								<div class="row">
									<div class="col-lg-4">Harga Beli</div>
									<div class="col-lg-8"><input type="text" name="hargabeli" class="kosong form-control" ></div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="row">
									<div class="col-lg-4">Harga Jual</div>
									<div class="col-lg-8"><input type="text" name="hargajual" class="kosong form-control"></div>
								</div>
							</div>
						</div>
						<div class="row my-1">
							<div class="col-lg-6">
								<div class="row">
									<div class="col-lg-4">Jenis Barang</div>
									<div class="col-lg-8">
										<select name="jenis" class="kosong form-control">
											<option>Pilih Jenis</option>
											@foreach($datajenis as $d)
											<option>{{$d->jenis}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="row">
									<div class="col-lg-4">Satuan</div>
									<div class="col-lg-8"><input type="text" name="satuan" class="kosong form-control"></div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-6">
								<button type="submit" class="btn bgcolor1 text-light my-2">Kirim</button>
							</div>
						</div>
					</form>
				</div>
			</div>
	</div>
		</div>
			<div class="row my-2">
				<div class="col-lg-4">
					<input type="text" class="kosong form-control search"  name="" placeholder="Cari..">
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12" id="StokLoad"></div>
			</div>
</div>