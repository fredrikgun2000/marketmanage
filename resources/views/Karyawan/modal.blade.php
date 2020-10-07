
				<div class="row my-2">
					@foreach($EditUser as $d)
					<div class="col-lg-12">
						<input type="hidden" name="id" id="id" class="form-control" value="{{$d->id}}">
						<div class="row">
							<div class="col-lg-4">Nama Karyawan</div>
							<div class="col-lg-8"><input type="text" name="nama" id="nama" class="form-control" value="{{$d->namapengguna}}"></div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-4">Sandi</div>
							<div class="col-lg-8"><input type="password"  id="sandi" class="form-control"></div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-4">Posisi</div>
							<div class="col-lg-8">
								<select id="posisi2">
									<option>Karyawan</option>
									<option>Admin</option>
								</select>
							</div>
						</div>
					</div>
					@endforeach
</div>