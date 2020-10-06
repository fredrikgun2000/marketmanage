<div style="max-height:300px;overflow-y: scroll; text-align: center;" class="my-2">
<table border="1" style="text-align: center;width: 100%;">
	<thead >
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
	
	@foreach($datapelunasan as $d)
	<tbody>
	<tr style="background-color: white;" >
		<td>{{$d->notransaksi}}	<input type="hidden" name="" class="subtotal1" value="{{$d->grandtotal}}"><input type="hidden" name="" class="subtotalp1" value="{{$d->pelunasan}}"></td>
		<td>{{$d->tanggal}}</td>
		<td>{{$d->tempo}}</td>
		<td>{{$d->supplier}}</td>
		<td class="rupiah">{{$d->grandtotal}}</td>
		<td class="rupiah">{{$d->pelunasan}}</td>
		<td><button id="{{$d->notransaksi}}" class="collapselaporan btn-warning btn" data-toggle="collapse" data-target="#DetailTransaksiBeli" aria-expanded="false" aria-controls="collapseExample">Detail</button>
		<button class="btn-success btn idmodal" data-toggle="modal" data-target="#IdModal" id="{{$d->notransaksi}}">Bayar</button>
	</td>
	</tbody>
	@endforeach
</table>
</div>
<div id="DetailTransaksiBeli" class="collapse"></div>

<div class="modal fade" id="IdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Masukan Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/PelunasanTPost">
      	@csrf
      <div class="modal-body">
      	<div class="row">
      		<div class="col-lg-12">
			 			<div class="row">
			 				<div class="col-lg-4">
			 					<label>Tanggal Bayar</label>
			 				</div>
			 				<div class="col-lg-8">
			 					<input type="text" id="tanggal1" name="tanggalpost" value="<?php echo date('d-m-Y'); ?>">
			 				</div>
			 			</div>

						</div>
      	</div>
      	<div class="row">
      		<div class="col-lg-12">
		        <input type="hidden" name="idmodal" id="getidmodal">
		        Total yang dibayar : Rp<input type="number" name="total">
      		</div>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Setor</button>
      </div>
      </form>
    </div>
  </div>
</div>