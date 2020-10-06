@extends('main')
@section('stok')
<input type="hidden" name="" id="pagination" value="Stok">
<div class="container-fluid">
	<div class="row">
		<ul class="text-success">
			<li class="d-inline mx-2 master remove" id="Barang">Barang</li>
			<li class="d-inline mx-2 master" id="Supplier">Supplier</li>
		</ul>
	</div>
</div>
<div id="ShowBarang"></div>
<div id="ShowSupplier"></div>
@endsection