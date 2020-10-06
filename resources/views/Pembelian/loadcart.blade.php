<div style="max-height:400px;overflow-y: scroll;">
<table border="1" style="text-align: center;width: 100%;">
	<thead >
	<tr class="bg-dark text-light">
		<td>#</td>
		<td>Kode</td>
		<td>Nama Barang</td>
		<td>Qty</td>
		<td>Satuan</td>
		<td>Harga</td>
		<td>Disc %</td>
		<td>Disc %</td>
		<td>Disc </td>
		<td>Jumlah</td>
		<td>S</td>
		<td>D</td>
	</tr>
	</thead>
	
	<?php $no = 0;?>
	@foreach($CartLoad as $d)
	<?php $no++ ;?>	
	<tbody>
	<tr style="background-color: white;">
		<td>{{$no}}</td>
		<td><input type="hidden" name="kode[]" value="{{$d->kode}}">{{$d->kode}}</td>
		<td>{{$d->nama}}</td>
		<td><input type="number" value="{{$d->qty}}" class="qty{{$d->kode}} qtyc" id="{{$d->kode}}" min="1" name="qty[]"></td>
		<td>{{$d->satuan}}</td>
		<td>{{$d->hargacartbeli}}<input type="hidden" name="" id="hargacart{{$d->kode}}" value="{{$d->hargacartbeli}}"></td>
		<td><input type="number" min="0" value="{{$d->disc1}}" id="{{$d->kode}}" class="disc1k{{$d->kode}} d1c" size="4"></td>
		<td><input type="number" min="0" value="{{$d->disc2}}" id="{{$d->kode}}" class="disc2k{{$d->kode}} d2c" size="4"></td>
		<td><input type="number" min="0" value="{{$d->discnominal}}" id="{{$d->kode}}" class="discnominal{{$d->kode}} dnc" size="8"></td>
		<td id="subtotals{{$d->kode}}" class="rupiah">{{$d->subtotal}}</td>
		<td><button type="button" class="btn btn-success ShowStok" id="{{$d->kode}}">S</button></td>
		<td><a href="/CartBeliDelete/{{$d->kode}}" class="btn btn-danger">D</a></td>
	</tr>
	<input type="hidden" id="subtotal{{$d->kode}}" class="subtotal1" value="{{$d->subtotal}}" size="4">
	</tbody>
	@endforeach
</table>
</div>