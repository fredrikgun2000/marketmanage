<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="/js/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/js/instascan.min.js"></script>
</head>
<body><video id="camera"></video>
<div id="qrcode" />


<div class="row">
<div class="col-md-6 col-md-offset-3 text-center" style="background-color:#e2e2e2;">
<h1>QR Code Generator</h1>
 
<div>
<p>Enter Text to embed in QR Code</p>
<p><textarea name="txt" style="height:50px;width:350px;" required="required"></textarea></p>
 
<p>Image Size : <select name="size">
<option value="100x100" selected>100x100</option>
<option value="200x200">200x200</option>
<option value="300x300" >300x300</option>
</select></p>
<p><input type="submit" value="Generate QR Code" id="qr-gn"></p>
</div>
 
<br/>
<div id="qrcode"></div>
 
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
</body>
<script type="text/javascript">
    let scanner = new Instascan.Scanner({
  video: document.getElementById("camera")
});

let resultado = document.getElementById("qrcode");
scanner.addListener("scan", function(content) {
  resultado.innerText = content;
  scanner.stop();
});
Instascan.Camera.getCameras()
  .then(function(cameras) {
    if (cameras.length > 0) {
      scanner.start(cameras[0]);
    } else {
      resultado.innerText = "No cameras found.";
    }
  })
  .catch(function(e) {
    resultado.innerText = e;
  });
</script>
</html>