
				<div class="row my-2">
					@foreach($EditSupplier as $d)
					<div class="col-lg-6">
						<input type="hidden" name="id" id="id" class="form-control" value="{{$d->id}}">
						<div class="row">
							<div class="col-lg-4">Nama Supplier</div>
							<div class="col-lg-8"><input type="text" name="nama" id="nama" class="form-control" value="{{$d->nama}}"></div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="row">
							<div class="col-lg-4">NoTelp Supplier</div>
							<div class="col-lg-8"><input type="number" name="telepon" id="telepon" class="form-control" value="{{$d->telepon}}"></div>
						</div>
					</div>
					@endforeach
