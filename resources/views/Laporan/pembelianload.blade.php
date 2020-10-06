<div style="max-height:300px;overflow-y: scroll; text-align: center;" class="my-2">
<table border="1" style="text-align: center;width: 100%;" id="tablelaporanbeli">
	<thead >
	<tr class="bg-dark text-light">
		<td>notransaksi</td>
		<td>tanggal</td>
		<td>supplier</td>
		<td>subtotal</td>
		<td>disc %</td>
		<td>disc</td>
		<td>grandtotal</td>
		<td>metode</td>
		<td>Method</td>
	</tr>
	</thead>
	
	<tbody>
	@foreach($datalaporan as $d)
	<tr style="background-color: white;" class="collapselaporan" id="{{$d->notransaksi}}" data-toggle="collapse" data-target="#DetailTransaksiBeli" aria-expanded="false" aria-controls="collapseExample">
		<td>{{$d->notransaksi}}	<input type="hidden" name="" class="subtotal1" value="{{$d->grandtotal}}"></td>
		<td>{{$d->tanggal}}</td>
		<td>{{$d->supplier}}</td>
		<td class="rupiah">{{$d->subtotalt}}</td>
		<td>{{$d->disc1t}}</td>
		<td>{{$d->discnominalt}}</td>
		<td class="rupiah">{{$d->grandtotal}}</td>
		<td>{{$d->metode}}</td>
		<td><button class="btn btn-warning detilpelunasanbayar" id="{{$d->notransaksi}}" data-toggle="modal" data-target="#detilpelunasanbayar">Detail</button></td>
	</tr>
	@endforeach
	</tbody>
</table>
</div>
<div id="DetailTransaksiBeli" class="collapse"></div>
<div class="modal fade" tabindex="-1" role="dialog" id="detilpelunasanbayar" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="max-height: 400px; overflow-y: scroll;">
      	<div id="showtanggalbayar"></div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
