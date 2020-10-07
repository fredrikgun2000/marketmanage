<div id="untunghapus">
<div class="row text-right">
	<div class="col-lg-12">Total Jual :<b class="mx-3 rupiah" id="grandjualt"></b></div>
	<input type="hidden" name="" id="grandjual">
</div>
<div class="row text-right">
	<div class="col-lg-12">Total Pembelian :<b class="mx-3 rupiah" id="grandbelit"></b></div>
	<input type="hidden" name="" id="grandbeli">
</div>
<div class="row text-right">
	<div class="col-lg-12">Total Untung :<b class="mx-3 rupiah text-success" id="granduntungt"></b></div>
</div>

<div class="row">
	<div class="col-lg-6">
			Rincian Jual
		<div style="max-height:300px;overflow-y: scroll; text-align: center;" class="my-2">
		<table border="1" style="text-align: center;width: 100%;" id="tableuntung">
			<thead >
			<tr class="bg-dark text-light">
				<td>notransaksi</td>
				<td>tanggal</td>
				<td>grandtotal</td>
			</tr>
			</thead>
			
			<tbody>
			@foreach($datauntungjual as $d)
			<tr style="background-color: white;">
				<td>{{$d->notransaksi}}	<input type="hidden" name="" class="subtotal1" value="{{$d->grandtotal}}"></td>
				<td>{{$d->tanggal}}</td>
				<td class="rupiah">{{$d->grandtotal}}</td>
			</tr>
			@endforeach
			</tbody>
		</table>
		</div>
	</div>
	<div class="col-lg-6">
			Rincian Beli
		<div style="max-height:300px;overflow-y: scroll; text-align: center;" class="my-2">
		<table border="1" style="text-align: center;width: 100%;" id="tableuntung2">
			<thead >
			<tr class="bg-dark text-light">
				<td>notransaksi</td>
				<td>tanggal</td>
				<td>grandtotal</td>
			</tr>
			</thead>
			
			<tbody>
			@foreach($datauntungbeli as $d)
			<tr style="background-color: white;">
				<td>{{$d->notransaksi}}	<input type="hidden" name="" class="subtotal1" value="{{$d->grandtotal}}"></td>
				<td>{{$d->tanggal}}</td>
				<td class="rupiah">{{$d->grandtotal}}</td>
			</tr>
			@endforeach
			</tbody>
		</table>
		</div>
	</div>
</div>

@foreach($datauntungbeli as $d)
<input type="hidden" name="" class="grandbeli" value="{{$d->grandtotal}}">
@endforeach


@foreach($datauntungjual as $d)
<input type="hidden" name="" class="grandjual" value="{{$d->grandtotal}}">
@endforeach

</div>