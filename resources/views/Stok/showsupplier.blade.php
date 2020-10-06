<div id="subsupplier">
	<div class="container-fluid">
	<div class="row bgcolor2 my-2 py-2">
		<div class="col-lg-12">
			
		<form id="SupplierForm" action="POST" >
			@csrf
			<div class="row my-2">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-4">Nama Supplier</div>
						<div class="col-lg-8"><input type="text" name="nama" class="form-control kosong"></div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-4">Nomor Telepon Supplier</div>
						<div class="col-lg-8"><input type="number" name="telepon" class="form-control kosong"></div>
					</div>
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
			<input type="text" class="form-control kosong search"  name="" id="" placeholder="Cari..">
		</div>
	</div>
		<div class="row">
			<div class="col-lg-12" id="SupplierLoad">
			</div>
		</div>
	</div>
</div>