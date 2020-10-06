<table border="1" width="100%;" style="text-align: center;">
	<tr class="bg-dark text-light">
		<td>#</td>
		<td>Kode</td>
		<td>Nama</td>
		<td class="hb">H Beli</td>
		<td>H Jual</td>
		<td>Satuan</td>
		<td>Jenis</td>
		<td>Stok</td>
		<td class="remove">Action</td>
	</tr>
	
	<?php $no = 0;?>
	@foreach($StokLoad as $d)
	<?php $no++ ;?>
	<tr style="background-color: white;">
		<td>{{$no}}</td>
		<td>{{$d->kode}}</td>
		<td>{{$d->nama}}</td>
		<td class="hb rupiah">{{$d->hargabeli}}</td>
		<td class="rupiah">{{$d->hargajual}}</td>
		<td>{{$d->satuan}}</td>
		<td>{{$d->jenis}}</td>
		<td>{{$d->stok}}</td>
		<td class="remove">
			<button class="btn btn-warning StokEdit" id="{{$d->id}}" data-toggle="modal" data-target="#ModalStok">E</button>
			<button id="{{$d->id}}" class="btn btn-danger btndelete" data-toggle="modal" data-target=".modaldelete">D</button>
		</td>
	</tr>
	@endforeach
</table>


	<div class="modal fade" id="ModalStok" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
		      <div class="modal-body">
		      	<div id="StokLoadModal"></div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-warning" id="editbarang" data-dismiss="modal">Update</button>
		      </div>	    
		  </div>
	  </div>
	</div>

<div class="modal fade modaldelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Apakah anda yakin ingin menghapus?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a id="idntndelete" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>