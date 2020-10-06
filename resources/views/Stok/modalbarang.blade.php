		        @foreach($EditStok as $d)
						<input type="hidden" name="id" id="id" class="form-control" value="{{$d->id}}">
						<div class="row my-1">
							<div class="col-lg-6">
								<div class="row">
									<div class="col-lg-4">Kode Barang</div>
									<div class="col-lg-8"><input type="text" name="kode" id="kode" class="form-control" value="{{$d->kode}}"></div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="row">
									<div class="col-lg-4">Nama Barang</div>
									<div class="col-lg-8"><input type="text" name="nama" id="nama" class="form-control" value="{{$d->nama}}"></div>
								</div>
							</div>
						</div>
						<div class="row my-1">
							<div class="col-lg-6">
								<div class="row">
									<div class="col-lg-4">Harga Beli</div>
									<div class="col-lg-8"><input type="text" name="hargabeli" id="hargabeli" class="form-control" value="{{$d->hargabeli}}"></div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="row">
									<div class="col-lg-4">Harga Jual</div>
									<div class="col-lg-8"><input type="text" id="hargajual" name="hargajual" class="form-control" value="{{$d->hargajual}}"></div>
								</div>
							</div>
						</div>
					@endforeach
						<div class="row my-1">
							<div class="col-lg-6">
								<div class="row">
									<div class="col-lg-4">Jenis Barang</div>
									<div class="col-lg-8">
										<select name="jenis" class="form-control" id="jeniss">
		        @foreach($EditStok as $d)
											<option>{{$d->jenis}}</option>
				@endforeach
				@foreach($datajenis as $d)
											<option>{{$d->jenis}}</option>
				@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="my-1 row">
							<div class="col-lg-6">
								<div class="row">
		        @foreach($EditStok as $d)
									<div class="col-lg-4">Satuan</div>
									<div class="col-lg-8"><input type="text" name="satuan" id="satuan" class="form-control" value="{{$d->satuan}}"></div>
				@endforeach
								</div>
							</div>
						</div>
