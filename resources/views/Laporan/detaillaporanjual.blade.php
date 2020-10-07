Detail Transaksi
<div style="max-height:300px;overflow-y: scroll; text-align: center;" class="my-2">
<table border="1" style="text-align: center;width: 100%;">
	<thead >
	<tr class="bg-dark text-light">
		<td>kode</td>
		<td>nama</td>
		<td>qty</td>
		<td>modal</td>
		<td>harga jual</td>
		<td>disc %</td>
		<td>disc %</td>
		<td>discnominal</td>
		<td>modaltotal</td>
		<td>subtotal</td>
		<td>untung</td>
	</tr>
	</thead>
	
	@foreach($datacart as $d)
	<tbody>
	<tr style="background-color: white;">
		<td>{{$d->kode}}</td>
		<td>{{$d->nama}}</td>
		<td>{{$d->qty}}</td>
		<td class="rupiah">{{$d->hargabeli}}</td>
		<td class="rupiah">{{$d->hargajual}}</td>
		<td>{{$d->disc1}}</td>
		<td>{{$d->disc2}}</td>
		<td class="rupiah">{{$d->discnominal}}</td>
		<td class="rupiah">{{$d->modaltotal}}</td>
		<td class="rupiah">{{$d->subtotal}}</td>
		<td class="rupiah">{{$d->untung}}</td>
	</tbody>
	@endforeach
</table>
</div>
