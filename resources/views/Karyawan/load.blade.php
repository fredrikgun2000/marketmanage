<table border="1" width="100%;" id="tablestaff">
	<tr class="bg-dark text-light">
		<td>#</td>
		<td>Nama Karyawan</td>
		<td>Posisi</td>
		<td>Action</td>
	</tr>
	
	<?php $no = 0;?>
	@foreach($KaryawanLoad as $d)
	<?php $no++ ;?>
	<tr style="background-color: white;">
		<td>{{$no}}</td>
		<td>{{$d->namapengguna}}</td>
		<td>{{$d->posisi}}</td>
		<td>
			<button class="btn btn-warning UserEdit" id="{{$d->id}}" data-toggle="modal" data-target="#ModalUser">E</button>
			<a href="UserrDelete/{{$d->id}}" class="btn btn-danger">D</a>
		</td>
	</tr>
	@endforeach
</table>

<div class="modal fade" id="ModalUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Edit Karyawan</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
		      <div class="modal-body">
		      	<div id="UserLoadModal"></div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-warning" id="edituser" data-dismiss="modal">Update</button>
		      </div>
	    </div>
	  </div>
	</div>