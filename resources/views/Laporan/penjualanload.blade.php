<div style="max-height:300px;overflow-y: scroll; text-align: center;" class="my-2">
<table border="1" style="text-align: center;width: 100%;" id="tablelaporanjual">
	<thead >
	<tr class="bg-dark text-light">
		<td>notransaksi</td>
		<td>tanggal</td>
		<td>subtotal</td>
		<td>disc %</td>
		<td>disc</td>
		<td>Modal Total</td>
		<td>grandtotal</td>
		<td>Untung Total</td>
		<td>metode</td>
	</tr>
	</thead>
	
	<tbody>
	@foreach($datalaporan as $d)
	<tr style="background-color: white;" class="collapselaporanjual" id="{{$d->notransaksi}}" data-toggle="collapse" data-target="#DetailTransaksijs" aria-expanded="false" aria-controls="collapseExample">
		<td>{{$d->notransaksi}}	<input type="hidden" name="" class="subtotaljual1" value="{{$d->grandtotal}}"></td>
		<td>{{$d->tanggal}}</td>
		<td class="rupiah">{{$d->subtotalt}}</td>
		<td>{{$d->disc1t}}</td>
		<td class="rupiah">{{$d->discnominalt}}</td>
		<td class="rupiah">{{$d->modaltotalcart}}</td>
		<td class="rupiah">{{$d->grandtotal}}</td>
		<td class="rupiah">{{$d->untungtotal}}</td>
		<input type="hidden" class="untungtotallap" value="{{$d->untungtotal}}">
		<td>{{$d->metode}}</td>
	</tr>
	@endforeach
	</tbody>
</table>
</div>
<div id="DetailTransaksijs" class="collapse"></div>

