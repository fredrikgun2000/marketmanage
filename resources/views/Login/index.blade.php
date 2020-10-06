<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <link rel="stylesheet" type="text/css" href="/css/main.css">

  <div class="container-fluid">
  	<div class="row">
  		<div class="col-lg-12">
  		<h1 class="text-center my-2">
  			 <span class="color1">Manage</span>Market
  		</h1>
  		</div>
  	</div>
  	<div class="row">
  		<div class="col-lg-6 mx-auto">
			<form method="POST" action="/LoginPost">
				@csrf
				<div class="row my-2">
					<div class="col-lg-12">
						Nama Pengguna
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<input type="text" name="namapengguna" class="form-control">
					</div>
				</div>
				 @if ($message = Session::get('messagenama'))
				    <div class="alert alert-danger">
				        {{ $message }}
				    </div>
				@endif
				<div class="row my-2">
					<div class="col-lg-12">
						Kata Sandi
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<input type="password" name="katasandi" class="form-control">
					</div>
				</div>
				 @if ($message = Session::get('messagesandi'))
				    <div class="alert alert-danger">
				        {{ $message }}
				    </div>
				@endif
				<div class="row">
					<div class="col-lg-12">
						<button type="submit" class="form-control btn bgcolor1 text-light my-2">Masuk</button>
					</div>
				</div>
			</form>
  		</div>
  	</div>
  </div>

</body>
</html>