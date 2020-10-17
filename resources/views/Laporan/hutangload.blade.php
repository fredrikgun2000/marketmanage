<div style="max-height:300px;overflow-y: scroll; text-align: center;" class="my-2">
<table border="1" style="text-align: center;width: 100%;" id="tablelaporanhutang">
	<thead>
	<tr class="bg-dark text-light">
		<td>notransaksi</td>
		<td>tanggal transaksi</td>
		<td>jatuh tempo</td>
		<td>supplier</td>
		<td>grandtotal</td>
		<td>Pelunasan</td>
		<td>Method</td>
	</tr>
	</thead>
	
	<tbody>
	@foreach($datapelunasan as $d)
	<tr style="background-color: white;" id="{{$d->notransaksi}}" class="collapselaporan" data-toggle="collapse" data-target="#DetailTransaksiBelis" aria-expanded="false" aria-controls="collapseExample" >
		<td>{{$d->notransaksi}}</td>
		<td>{{$d->tanggal}}</td>
		<td>{{$d->tempo}}</td>
		<td>{{$d->supplier}}</td>
		<td class="rupiah">{{$d->grandtotal}}</td>
		<input type="hidden" class="hutanglap" value="{{$d->grandtotal}}">
		<input type="hidden" class="pelunasanlap" value="{{$d->pelunasan}}">
		<td class="rupiah">{{$d->pelunasan}}</td>
		<td><button class="btn btn-warning detilpelunasanbayar" id="{{$d->notransaksi}}" data-toggle="modal" data-target="#detilpelunasanbayarh">Detail</button></td>
	</tr>
	@endforeach
	</tbody>
</table>
</div>
<div id="DetailTransaksiBelis" class="collapse"></div>
<div class="modal fade" tabindex="-1" role="dialog" id="detilpelunasanbayarh" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="max-height: 400px; overflow-y: scroll;">
      	<div id="showtanggalbayar2"></div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>