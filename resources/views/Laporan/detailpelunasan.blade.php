<div class="row">
	<div class="col-lg-12">
		<?php $no = 0;?>
		@foreach($datapelunasan as $d)
		<?php $no++ ;?>	
		<div class="row">
			<div class="col-lg-1"><b>{{$no}}</b></div>
			<div class="col-lg-11">
				<div class="row">
					<div class="col-lg-4">
						<b>Tanggal: </b> 
					</div>
					<div class="col-lg-8">{{$d->tanggalbayar}} </div>
				</div>
				<div class="row">
					<div class="col-lg-4">
						<b>Total :</b>
					</div>
					<div class="col-lg-8 rupiah">{{$d->totalbayar}}</div>
				</div>
				<div class="row">
					<div class="col-lg-4">
						<b>Sisa Hutang :</b> 
					</div>
					<div class="col-lg-8 rupiah">{{$d->sisa}}</div>
				</div>
			</div>
		</div>
		<hr>
			@endforeach
	</div>
</div>