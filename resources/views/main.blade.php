<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/wickedpicker.css">
  <link rel="stylesheet" type="text/css" href="/css/main.css">
<style>
table{
  text-align: center;
}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #247CF0;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  color: white;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

#ui-datepicker-div{
  background-color: white;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body >
  <?php
    $login=Session::get('Login');
    if ($login!='true') {
  ?>
    <meta http-equiv="refresh" content="0;URL=/" />
  <?php
    }
  ?>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn bgcolor1" onclick="closeNav()">&times;</a>
  <a href="#">{{Session::get('namapengguna')}}</a>
  <hr style="width: 80%;margin: auto;background-color: white;">
  <a href="/Scanning" id="Scanning">Penjualan</a>
  <a href="/Pembelian" id="Pembelian">Pembelian</a>
  <a href="/Pelunasan" id="Pelunasan">Pelunasan</a>
  <a href="/Stok" id="Stok">Stok</a>
  <a href="/Laporan" id="Laporan">Laporan</a>
  <a href="/Karyawan" id="Karyawan">Karyawan</a>
  <hr style="width: 80%;margin: auto;background-color: white;">
  <a href="/Logout" class="text-danger">LogOut</a>
  
</div>

<input type="hidden" id="iduser" value="{{Session::get('namapengguna')}}">
<input type="hidden" id="posisi" value="{{Session::get('posisi')}}">
<input type="hidden" id="SubPagination">


<div class="container-fluid">
    <div class="row bgcolor2 mb-4" style="box-shadow: 5px 1px 8px black;">
      <div class="col-lg-12">
      <h1 class="text-center my-2" onclick="openNav()">
         <span class="color1">Manage</span>Market
      </h1>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        @yield('laporan')
        @yield('karyawan')
        @yield('stok')
        @yield('scanning')
        @yield('pembelian')
        @yield('pelunasan')
      </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="js/wickedpicker.js"></script>
<script src="js/autoNumeric.js"></script>
<script src="/js/main.js"></script>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
</body>
</html>