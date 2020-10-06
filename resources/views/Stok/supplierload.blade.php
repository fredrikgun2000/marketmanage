<table border="1" width="100%;" style="text-align: center;">
	<tr class="bg-dark text-light">
		<td>#</td>
		<td>Nama</td>
		<td>No Telepon</td>
		<td>Action</td>
	</tr>
	
	<?php $no = 0;?>
	@foreach($SupplierLoad as $d)
	<?php $no++ ;?>
	<tr style="background-color: white;">
		<td>{{$no}}</td>
		<td>{{$d->nama}}</td>
		<td>{{$d->telepon}}</td>
		<td>
			<button class="btn btn-warning SupplierEdit" id="{{$d->id}}" data-toggle="modal" data-target="#ModalSupplier">E</button>
			<a href="/SupplierDelete/{{$d->id}}" class="btn btn-danger">D</a>
		</td>
	</tr>
	@endforeach
</table>


	<div class="modal fade" id="ModalSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Edit Supplier</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form id="SupplierUpdate" method="POST">
		      <div class="modal-body">
		      	<div id="SupplierLoadModal"></div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-warning" id="editsupplier" data-dismiss="modal">Update</button>
		      </div>
	      </form>
	    </div>
	  </div>
	</div>