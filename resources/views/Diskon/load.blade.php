<div style="max-height: 350px; overflow-y: auto;">
	<table border="1" width="100%;" style="text-align: center;">
	<tr class="bg-dark text-light">
		<td>#</td>
		<td>Kode Barang</td>
		<td>Tgl Mulai</td>
		<td>Tgl Akhir</td>
		<td>minimal pembelian</td>
		<td>Diskon</td>
		<td>Action</td>
		
	</tr>
	
	<?php $no = 0;?>
	@foreach($DiskonLoad as $d)
	<?php $no++ ;?>
	<tr style="background-color: white;">
		<td>{{$no}}</td>
		<td>{{$d->kodebarang}}</td>
		<td>{{$d->tanggalmulai}}</td>
		<td>{{$d->tanggalakhir}}</td>
		<td>{{$d->minitem}}</td>
		<td class="rupiah">{{$d->diskon}}</td>
		<td class="remove">
			<button class="btn btn-warning editdiskons" id="{{$d->id}}" data-toggle="modal" data-target="#ModalDiskon">E</button>
		</td>
	</tr>
	<input type="hidden" id="iddiskons" value="{{$d->id}}">
	<input type="hidden" id="kodebarangs{{$d->id}}" value="{{$d->kodebarang}}">
	@endforeach
</table>
</div>


	<div class="modal fade" id="ModalDiskon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Edit Diskon</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
		      <div class="modal-body">
		      	<div class="container-fluid">
				<input type="hidden" name="iddiskon" id="iddiskon">
					<div class="row">
						<div class="col-lg-12">
							Kode Barang
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<b  class="" id="kodebarang"></b>
							<input type="hidden" id="kodebarangx">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							Tanggal Mulai
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<input  class="form-control" name="tanggalmulai" id="tanggalmulai">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							Tanggal Akhir
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<input  class="form-control" name="tanggalakhir" id="tanggalakhir">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							 Minimal Pembelian
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<input type="number" class="form-control" name="minitem" id="minitem">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							Diskon Persen
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<input type="number" class="form-control" name="diskonpersen" id="diskonpersen" max="100">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							Diskon Nominal
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<input type="number" class="form-control" name="diskonnominal" id="diskonnominalx">
						</div>
					</div>
					
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-warning" id="editdiskon" data-dismiss="modal">Update</button>
		      </div>	    
		  </div>
	  </div>
	</div>
