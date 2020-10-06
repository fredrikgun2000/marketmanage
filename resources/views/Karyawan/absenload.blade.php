<table border="1" width="100%;" id="tablestaff">
	<tr class="bg-dark text-light">
		<td>#</td>
		<td>Tanggal</td>
		<td>waktu</td>
		<td>staff</td>
		<td>pengabsen</td>
		<td>Action</td>
	</tr>
	
	<?php $no = 0;?>
	@foreach($dataabsen as $d)
	<?php $no++ ;?>
	<tr style="background-color: white;">
		<td>{{$no}}</td>
		<td>{{$d->tanggal}}</td>
		<td>{{$d->waktu}}</td>
		<td>{{$d->staff}}</td>
		<td>{{$d->pengabsen}}</td>
		<td>
			<a href="AbsenDelete/{{$d->id}}" class="btn btn-danger">D</a>
		</td>
	</tr>
	@endforeach
</table>