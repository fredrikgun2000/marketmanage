//dinamis
$(document).ready(function() {
	CekDiskon();
	CekPosisi();
	LoadPagination();
	LoadKaryawan();
	ShowBarang();
	LoadStock();
	LoadCart();
	$('#kodex').focus();
	setInterval(Scan,1000);
	hitung2();
	LaporanPembelianLoad();
	$( '#tanggal1' ).datepicker({dateFormat: 'yy-mm-dd'}).val(); 
	$('#tanggal2').datepicker({dateFormat: 'yy-mm-dd'}).val();
	$( '#tanggal1un' ).datepicker({dateFormat: 'yy-mm-dd'}).val(); 
	$('#tanggal2un').datepicker({dateFormat: 'yy-mm-dd'}).val();
	$( '#tanggal1s' ).datepicker({dateFormat: 'yy-mm-dd'}).val(); 
	$('#tanggal2s').datepicker({dateFormat: 'yy-mm-dd'}).val();
	$('#tanggal3' ).datepicker({dateFormat: 'yy-mm-dd'}).val(); 
	$('#tanggal4').datepicker({dateFormat: 'yy-mm-dd'}).val();
	$('#tanggalmulai').datepicker({dateFormat: 'yy-mm-dd'}).val();
	$('#tanggalakhir').datepicker({dateFormat: 'yy-mm-dd'}).val();
	$('#tanggalxx').datepicker({dateFormat: 'yy-mm-dd'}).val();
	$('#jam').wickedpicker({ twentyFour:true}).val();
	$('input').attr('autocomplete','off');
	$('#subpembelian').css({"border":"1px solid #28a785","padding":"2px"});
	$('ul #Barang').css({"border":"1px solid #28a785","padding":"2px"});
	if ($('#pagination').val()=='Karyawan') {
	$('#subabsen').css({"border":"1px solid #28a785","padding":"2px"});
	}
	AbsenLoad();
	$('.rupiah').autoNumeric('init',{
	aDec:',',
	aSep:'.'
	});

})
//submit
$(document).on('submit','#StokForm',function(e){
	e.preventDefault();
	$.ajax({
		url:'/StokPost',
		method:'POST',
		data:new FormData(this),
		dataType:'JSON',
		contentType: false,
		cache: false,
		processData: false,
		success:function(data){
			LoadStock();
			LoadDiskon();
			$('.kosong').val('');
			$('#stokalert').html(data.err).show();
			if (data.err==null) {
				$('#stokalert').hide();
			}
		}
	})
})

$(document).on('submit','#SupplierForm',function(e){
	e.preventDefault();
	$.ajax({
		url:'/SupplierPost',
		method:'POST',
		data:new FormData(this),
		dataType:'JSON',
		contentType: false,
		cache: false,
		processData: false,
		success:function(data){
			LoadSupplier();
			$('.kosong').val('');
		},error:function(data){
			
		}
	})
})

$(document).on('submit','#KaryawanForm',function(e){
	e.preventDefault();
	$.ajax({
		url:'/KaryawanPost',
		method:'POST',
		data:new FormData(this),
		dataType:'JSON',
		contentType: false,
		cache: false,
		processData: false,
		success:function(data){
			LoadKaryawan();
			$('#alert').html(data.msg);
			$('#alert').attr('class','col-lg-12 alert alert-success');
			$('#namapengguna').val('');
			$('#katasandi').val('');
		},error:function(data){
			var error=JSON.parse(data.responseText)['errors'];
			$('#alert').html(error['namapengguna']+'<br>'+error['katasandi']);
			$('#alert').attr('class','col-lg-12 alert alert-danger');
		}
	})
})

//fungsi
function LoadPagination() {
	var pagination=$('#pagination').val();
	$('#'+pagination).css({
		'color':'#247CF0',
		'background-color':'white'
		})
}

function LoadSubPagination() {
	var SubPagination=$('#SubPagination').val();
	if (SubPagination=='subbarang') {
		$('#subsupplier').hide();
	}else if (SubPagination=='subsupplier') {
		$('#subbarang').hide();
	}else if (SubPagination=='subpembelian') {
		$('#subpenjualanf').hide();
		$('#subhutangf').hide();
		$('#tampilabsen').hide();
		$('#tampiluntung').hide();
		$('#tablelaporanhutang').remove();
		$('#tablelaporanbpenjualan').remove();
		$('#tablebsen').remove();
		$('#tableuntung').remove();
		$('#untunghapus').remove();
		LaporanPembelianLoad();
	}else if (SubPagination=='subpenjualan') {
		$('#subpembelianf').hide();
		$('#subhutangf').hide();
		$('#tampilabsen').hide();
		$('#tampiluntung').hide();
		$('#tablelaporanbeli').remove();
		$('#tablelaporanhutang').remove();
		$('#tablebsen').remove();
		$('#tableuntung').remove();
		$('#untunghapus').remove();
		LaporanPenjualanLoad()
	}else if (SubPagination=='subhutang') {
		$('#subpenjualanf').hide();
		$('#subpembelianf').hide();
		$('#tampilabsen').hide();
		$('#tampiluntung').hide();
		$('#tablelaporanbeli').remove();
		$('#tablelaporanjual').remove();
		$('#tablebsen').remove();
		$('#tableuntung').remove();
		$('#untunghapus').remove();
		HutangLoad();
	}else if (SubPagination=='subabsen') {
		$('#tampiltambahstaff').hide();
		$('#subpenjualanf').hide();
		$('#subpembelianf').hide();
		$('#subhutangf').hide();
		$('#tampiluntung').hide();
		$('#tablelaporanbeli').remove();
		$('#tablelaporanhutang').remove();
		$('#tablelaporanjual').remove();
		$('#tablestaff').remove();
		$('#tableuntung').remove();
		$('#untunghapus').remove();

		if ($('#pagination').val()=='Karyawan') {
			AbsenLoad();
		}else if ($('#pagination').val()=='Laporan') {
			LaporanAbsensiLoad();
		}
;	}else if (SubPagination=='substaffbaru') {
		$('#tampilabsen').hide();
		$('#tablebsen').remove();
		$('#untunghapus').remove();

	}else if (SubPagination=='subuntung') {
		$('#tampiltambahstaff').hide();
		$('#tampilabsen').hide();
		$('#subpenjualanf').hide();
		$('#subpembelianf').hide();
		$('#subhutangf').hide();
		$('#tablelaporanbeli').remove();
		$('#tablelaporanhutang').remove();
		$('#tablelaporanjual').remove();
		$('#tablestaff').remove();

	}
}

function CekPosisi() {
	var posisi=$('#posisi').val();
	if (posisi=='karyawan') {
		$('.remove').remove();
		$('#Pembelian').remove();
		$('#Pelunasan').remove();
		$('#Laporan').remove();
		$('#Karyawan').remove();
		$('#Supplier').remove();
		$('.hb').remove();
	}
}

function LoadKaryawan() {
	if ($('#pagination').val()=='Karyawan') {
		$.ajax({
			url:'/KaryawanLoad',
			method:'GET',
			success:function(data){
				$('#KaryawanLoad').html(data);
			}
		})
	}
}

function LoadStock() {
	if ($('#pagination').val()=='Stok') {
		$('#SubPagination').val('subbarang');
		$.ajax({
			url:'/StokLoad',
			method:'GET',
			success:function(data){
				$('#StokLoad').html(data);
				$('.rupiah').autoNumeric('init',{

			aDec:',',
			aSep:'.'
				});
				totalmodalstok();
				CekPosisi();
			}
		})
	}
}


function LoadDiskon() {
		$.ajax({
			url:'/DiskonLoad',
			method:'GET',
			success:function(data){
				$('#DiskonLoad').html(data);
				$('.rupiah').autoNumeric('init',{

			aDec:',',
			aSep:'.'
				});
				CekPosisi();
			}
		})
	
}

function LoadCart() {
	if ($('#pagination').val()=='Scanning') {
			$.ajax({
			url:'CartLoad/',
			method:'GET',
			success:function(data){
				$('#CartLoad').html(data);
				$('.rupiah').autoNumeric('init',{

			aDec:',',
			aSep:'.'
				});
				subtotal1();
			}
		})
		}else if ($('#pagination').val()=='Pembelian') {
			$.ajax({
			url:'CartBeliLoad/',
			method:'GET',
			success:function(data){
				$('#CartLoad').html(data);
				$('.rupiah').autoNumeric('init',{

			aDec:',',
			aSep:'.'
				});
				subtotal1();
			}
		})
		}
}

function LoadCart2(kode) {
	if ($('#pagination').val()=='Scanning') {
			$.ajax({
			url:'CartLoad/',
			method:'GET',
			success:function(data){
				$('#CartLoad').html(data);
				$('.rupiah').autoNumeric('init',{

			aDec:',',
			aSep:'.'
				});
				subtotal1();
				$('.qty'+kode).val('');
				$('.qty'+kode).focus();
			}
		})
		}else if ($('#pagination').val()=='Pembelian') {
			$.ajax({
			url:'CartBeliLoad/',
			method:'GET',
			success:function(data){
				$('#CartLoad').html(data);
				$('.rupiah').autoNumeric('init',{

			aDec:',',
			aSep:'.'
				});
				subtotal1();
				$('.qty'+kode).focus();
			}
		})
		}
}

function LoadSupplier() {
	if ($('#SubPagination').val()=='subsupplier') {
		$.ajax({
			url:'/SupplierLoad',
			method:'GET',
			success:function(data){
				$('#SupplierLoad').html(data);
			}
		})
	}
}

function LoadUser() {
	if ($('#SubPagination').val()=='substaffbaru') {
		$.ajax({
			url:'/KaryawanLoad',
			method:'GET',
			success:function(data){
				$('#KaryawanLoad').html(data);
			}
		})
	}
}

function ShowBarang() {
	$.ajax({
		url:'ShowBarang/',
		method:'GET',
		success:function(data){
			$('#ShowBarang').html(data);
	 		LoadSubPagination();
		}
	})
}

function ShowPelanggan() {
	$.ajax({
		url:'ShowPelanggan/',
		method:'GET',
		success:function(data){
			$('#ShowPelanggan').html(data);
	 		LoadSubPagination();
		}
	})
}

function ShowSupplier() {
	$.ajax({
		url:'ShowSupplier/',
		method:'GET',
		success:function(data){
			$('#ShowSupplier').html(data);
	 		LoadSubPagination();
		}
	})
}

 $(document).on('click','.master',function(){
 	var id=$(this).attr('id');
 	if (id=='Barang') {
 		$('#SubPagination').val('subbarang');
 		$(this).css({"border":"1px solid #28a785","padding":"2px"});
 		$('ul #Supplier').css({"border":"0"});
 		ShowBarang();
 		LoadStock();
 	}else if (id=='Supplier') {
 		$('#SubPagination').val('subsupplier');
 		$(this).css({"border":"1px solid #28a785","padding":"2px"});
 		$('ul #Barang').css({"border":"0"});
 		ShowSupplier();
 		LoadSupplier();
 	}
 })

function Scan(){
 	var kode=$('#kodex').val();
 	var pagination=$('#pagination').val();
 	if (pagination=='Scanning') {
	 	if (kode!='') {
			$.ajax({
				url:'/CartPost/'+kode,
				method:'GET',
				success:function(data){
					if (data.data1<data.data2) {
						alert('stok hanya :'+data.data1)
					}
					LoadCart();
			 		$('#kodex').val('');
			 		$('#kode2').val('');

				}
			})
 		}
 	}else if (pagination=='Pembelian') {
 		if (kode!='') {
			$.ajax({
				url:'/CartBeliPost/'+kode,
				method:'GET',
				success:function(data){
					LoadCart();
			 		$('#kodex').val('');
			 		$('#kode2').val('');
				}
			})
 		}
 	}
 }

$(document).on('click','#CartManualPost',function(){
 	var kode=$('#kode2').val();
 	var pagination=$('#pagination').val();
 	if (pagination=='Scanning') {
 		if (kode!='') {
			$.ajax({
				url:'/CartPost/'+kode,
				method:'GET',
				success:function(data){
					LoadCart2(kode);
			 		$('#kodex').val('');
			 		$('#kode2').val('');
				}
			})
		 }
 	}else{
 		if (kode!='') {
			$.ajax({
				url:'/CartBeliPost/'+kode,
				method:'GET',
				success:function(data){
					LoadCart2(kode);
			 		$('#kodex').val('');
			 		$('#kode2').val('');
				}
			})
		}
 	}
 })

 $(document).on('click','#scanbut',function(){
 	$('#kodex').focus();
 })

$('#kodex').on('blur', function(){
        $('#scanbut').show();
}).on('focus', function(){
        $('#scanbut').hide();
});

function hitung(id,qty,hargacart,disc1,disc2,discnominal) {
	var rumus1=(qty*hargacart)-(qty*hargacart*(disc1/100));
	var rumus2=rumus1-(rumus1*disc2/100);
	var subtotal=rumus2-discnominal;
	$('#subtotals'+id).html(uang(subtotal));
	$('#subtotal'+id).val(subtotal);
	subtotal1();
}

function hitung2() {
	var subtotal=$('#subtotala').val();
	var d1=parseInt($('#disc3k').val());
	var d2=parseInt($('#discnominal2').val());
	$('#disc3k').val(d1);
	$('#discnominal2').val(d2);
	if (isNaN(d1)) {
		$('#disc3k').val('0');
		d1=0;
	}
	if (isNaN(d2)) {
		$('#discnominal2').val('0');
		d2=0;
	}
	var rumus1=subtotal-subtotal*(d1/100);
	var rumus2=rumus1-d2;
	$('#grandtotal2').html(uang(rumus2));
	$('#grandtotal').val(rumus2);
}

function hitung4() {
	var a=$('#subtotala').val();
	var b=$('#subtotalpa').val();
	var rumus=a-b;
	$('#subtotalp2').html(rumus);
}

function hitung3() {
	var tunai=parseInt($('#tunai').val());
	var debit=parseInt($('#debit').val());
	var money=parseInt($('#money').val());
	$('#tunai').val(tunai);
	$('#debit').val(debit);
	$('#money').val(money);
	if (isNaN(tunai)) {
		$('#tunai').val('0');
		tunai=0;
	}
	if (isNaN(debit)) {
		$('#debit').val('0');
		debit=0;
	}
	if (isNaN(money)) {
		$('#money').val('0');
		money=0;
	}
	var grandtotal=parseInt($('#grandtotal').val());
	var rumus1=(tunai+debit+money)-grandtotal;
	var kembalian=$('#kembalian').html(rumus1);
}

function hutanglap() {
	var s=0;
	$('.hutanglap').each(function(){
		var a=$(this).val();
		s +=parseInt(a);
	});

	var d=0;
	$('.pelunasanlap').each(function(){
		var b=$(this).val();
		d +=parseInt(b);
	});
	var rumus=parseInt(s)-parseInt(d);
	$('#totalhutang').html(uang(rumus));
}

function untunglap() {
	var s=0;
	$('.untungtotallap').each(function(){
		var a=$(this).val();
		s +=parseInt(a);
	});
	$('#totaluntungx').html(uang(s));
}

function totalmodalstok() {
	var s=0;
	$('.totalhargabeli').each(function(){
		var a=$(this).val();
		s +=parseInt(a);
	});
	$('#totalmodalstok').html(uang(s));
}

function subtotal1() {
	var s=0;
	$('.subtotal1').each(function(){
		var a=$(this).val();
		s +=parseInt(a);
	});
	$('#subtotala').val(s);
	$('#subtotalb').html(uang(s));
	hitung2();
}

function subtotalp1() {
	var s=0;
	$('.subtotalp1').each(function(){
		var a=$(this).val();
		s +=parseInt(a);
	});
	$('#subtotalpa').val(s);
	$('#subtotalpb').html(uang(s));
}

function subtotaljual1() {
	var s=0;
	$('.subtotaljual1').each(function(){
		var a=$(this).val();
		s +=parseInt(a);
	});
	$('#subtotaljuala').val(s);
	$('#subtotaljualb').html(uang(s));
}

function DeleteId() {
	var seen = {};
	$('table tr').each(function() {
	    var txt = $(this).children("td:eq(0)").text();
	    if (seen[txt]){
	        $(this).remove();
			subtotal1();
	    }else{
	        seen[txt] = true;
			subtotal1();

	}});
	subtotalp1();
	subtotaljual1();
	hitung4();
}

function CartUpdate(id,qty,disc1,disc2,discnominal,subtotal) {
		alert(qty);
	if ($('#pagination').val()=='Scanning') {
			$.ajax({
			url:'/CartUpdate/'+id+'/'+qty+'/'+disc1+'/'+disc2+'/'+discnominal+'/'+subtotal,
			method:'GET',
			success:function(data){
			}
		})
		}else if ($('#pagination').val()=='Pembelian') {
			$.ajax({
			url:'/CartBeliUpdate/'+id+'/'+qty+'/'+disc1+'/'+disc2+'/'+discnominal+'/'+subtotal,
			method:'GET',
			success:function(data){
			}
		})
	}
}

function LaporanPembelianLoad() {
	if ($('#pagination').val()=='Laporan') {
		var kode=$('#kode').val();
		var tanggal1=$( '#tanggal1' ).datepicker({dateFormat: 'yy-mm-dd'}).val(); 
		var tanggal2=$('#tanggal2').datepicker({dateFormat: 'yy-mm-dd'}).val();
		var barang=$('#barang').val();
		var supplier=$('#supplier').val();
		var transaksi=$('#transaksill').val();
		var status=$('#status').val();
		$.ajax({
			url:'LaporanPembelianLoad',
			data:'kode='+kode+'&tanggal1='+tanggal1+'&tanggal2='+tanggal2+'&barang='+barang+'&supplier='+supplier+'&status='+status+'&transaksi='+transaksi,
			method:'GET',
			success:function(data){
				$('#LaporanPembelianLoad').html(data);
				DeleteId();
				$('.rupiah').autoNumeric('init',{

			aDec:',',
			aSep:'.'
				});
			}
		})
	}
}

function LaporanPenjualanLoad() {
	if ($('#pagination').val()=='Laporan') {
		var kode=$('#kodej').val();
		var tanggal1=$( '#tanggal1j' ).datepicker({dateFormat: 'yy-mm-dd'}).val(); 
		var tanggal2=$('#tanggal2j').datepicker({dateFormat: 'yy-mm-dd'}).val();
		var barang=$('#barang').val();
		var transaksi=$('#transaksilp').val();
		var penjual=$('#penjual').val();
		var status=$('#status').val();
		$.ajax({
			url:'LaporanPenjualanLoad',
			data:'kode='+kode+'&tanggal1='+tanggal1+'&tanggal2='+tanggal2+'&barang='+barang+'&transaksi='+transaksi,
			method:'GET',
			success:function(data){
				$('#LaporanPenjualanLoad').html(data);
				DeleteId();
				untunglap();
				$('.rupiah').autoNumeric('init',{

			aDec:',',
			aSep:'.'
				});

			}
		})
	}
}

function EditBarang() {
	if ($('#pagination').val()=='Stok') {
		var id=$('#id').val();
		var kode=$('#kode').val();
		var nama=$('#nama').val();
		var hargabeli=$('#hargabeli').val();
		var hargajual=$('#hargajual').val();
		var jenis=$('#jeniss').val();
		var satuan=$('#satuan').val();
		$.ajax({
			url:'StokUpdate',
			data:'id='+id+'&kode='+kode+'&nama='+nama+'&hargabeli='+hargabeli+'&hargajual='+hargajual+'&jenis='+jenis+'&satuan='+satuan,
			method:'GET',
			success:function(data){
				LoadStock();
				DeleteId();
			}
		})
	}
}

function EditDiskon() {
		var id=$('#iddiskon').val();
		var kodebarang=$('#kodebarangx').val();
		var tanggalmulai=$('#tanggalmulai').datepicker({dateFormat: 'yy-mm-dd'}).val();
		var tanggalakhir=$('#tanggalakhir').datepicker({dateFormat: 'yy-mm-dd'}).val();
		var minitem=$('#minitem').val();
		var diskonpersen=$('#diskonpersen').val();
		var diskonnominal=$('#diskonnominalx').val();
		$.ajax({
			url:'/DiskonUpdate',
			data:'id='+id+'&kodebarang='+kodebarang+'&tanggalmulai='+tanggalmulai+'&tanggalakhir='+tanggalakhir+'&minitem='+minitem+'&diskonpersen='+diskonpersen+'&diskonnominal='+diskonnominal,
			method:'GET',
			success:function(data){
				LoadDiskon();
				LoadStock();
				DeleteId();
			}
		})
}

function EditSupplier() {
	if ($('#pagination').val()=='Stok') {
		var id=$('#id').val();
		var nama=$('#nama').val();
		var telepon=$('#telepon').val();
		$.ajax({
			url:'SupplierUpdate',
			data:'id='+id+'&nama='+nama+'&telepon='+telepon,
			method:'GET',
			success:function(data){
				LoadSupplier();
				DeleteId();
			}
		})
	}
}

function EditUser() {
	if ($('#pagination').val()=='Karyawan') {
		var id=$('#id').val();
		var nama=$('#nama').val();
		var sandi=$('#sandi').val();
		var posisi=$('#posisi2').val();
		$.ajax({
			url:'UserUpdate',
			data:'id='+id+'&nama='+nama+'&sandi='+sandi+'&posisi='+posisi,
			method:'GET',
			success:function(data){
				LoadUser();
				DeleteId();
			}
		})
	}
}


function LaporanAbsensiLoad() {
	if ($('#pagination').val()=='Laporan') {
		var tanggal1=$( '#tanggal1s' ).datepicker({dateFormat: 'yy-mm-dd'}).val(); 
		var tanggal2=$('#tanggal2s').datepicker({dateFormat: 'yy-mm-dd'}).val();
		var admin=$('#admin').val();
		var staff=$('#staff').val();
		$.ajax({
			url:'LaporanAbsensiLoad',
			data:'tanggal1='+tanggal1+'&tanggal2='+tanggal2+'&admin='+admin+'&staff='+staff,
			method:'GET',
			success:function(data){
				$('#LaporanAbsenLoad').html(data);
				DeleteId();
			}
		})
	}
}

function LaporanUntungLoad() {
	if ($('#pagination').val()=='Laporan') {
		var tanggal1=$( '#tanggal1un' ).datepicker({dateFormat: 'yy-mm-dd'}).val(); 
		var tanggal2=$('#tanggal2un').datepicker({dateFormat: 'yy-mm-dd'}).val();
		$.ajax({
			url:'LaporanUntungLoad',
			data:'tanggal1='+tanggal1+'&tanggal2='+tanggal2,
			method:'GET',
			success:function(data){
				$('#LaporanUntungLoad').html(data);
				grand1();
				grand2();
				grand3();
			}
		})
	}
}


function Pelunasan() {
	if ($('#pagination').val()=='Pelunasan') {
		var kode=$('#kode').val();
		var tanggal1=$( '#tanggal1h' ).datepicker({dateFormat: 'yy-mm-dd'}).val(); 
		var tanggal2=$('#tanggal2h').datepicker({dateFormat: 'yy-mm-dd'}).val();
		var tanggal3=$( '#tanggal3' ).datepicker({dateFormat: 'yy-mm-dd'}).val(); 
		var tanggal4=$('#tanggal4').datepicker({dateFormat: 'yy-mm-dd'}).val();
		var transaksi=$('#transaksi').val();
		var supplier=$('#supplier').val();
		$.ajax({
			url:'PelunasanLoad',
			data:'transaksi='+transaksi+'&tanggal1='+tanggal1+'&tanggal2='+tanggal2+'&tanggal3='+tanggal3+'&tanggal4='+tanggal4+'&supplier='+supplier,
			method:'GET',
			success:function(data){
				$('#PelunasanLoad').html(data);
				$('.rupiah').autoNumeric('init',{

			aDec:',',
			aSep:'.'
				});
				DeleteId();
			}
		})
	}
}

function HutangLoad() {
	if ($('#SubPagination').val()=='subhutang') {
		var kode=$('#kode').val();
		var tanggal1=$( '#tanggal1h' ).datepicker({dateFormat: 'yy-mm-dd'}).val(); 
		var tanggal2=$('#tanggal2h').datepicker({dateFormat: 'yy-mm-dd'}).val();
		var tanggal3=$( '#tanggal3' ).datepicker({dateFormat: 'yy-mm-dd'}).val(); 
		var tanggal4=$('#tanggal4').datepicker({dateFormat: 'yy-mm-dd'}).val();
		var transaksi=$('#transaksi').val();
		var supplier=$('#suppliers').val();
		$.ajax({
			url:'HutangLoad',
			data:'transaksi='+transaksi+'&tanggal1='+tanggal1+'&tanggal2='+tanggal2+'&tanggal3='+tanggal3+'&tanggal4='+tanggal4+'&supplier='+supplier,
			method:'GET',
			success:function(data){
				$('#HutangLoad').html(data);
				DeleteId();
				
	$('.rupiah').autoNumeric('init',{
	aDec:',',
	aSep:'.'
	});
	hutanglap();
			}
		})
	}
}

function CekDiskon() {
	var get=sessionStorage.getItem('session_diskon');
	if (get!='tercek') {
		$.ajax({
			url:'http://localhost:8000/CekDiskon',
			method:'GET',
			success:function(data){
				sessionStorage.setItem('session_diskon','tercek');
				LoadDiskon();
			}
		})
	}else{
		console.log('tercek');
	}
}
 //eksekusi 2
$(document).on('click','#collapsediskon',function(){
	$('#tanggalmulai').datepicker({dateFormat: 'yy-mm-dd'}).val();
	$('#tanggalakhir').datepicker({dateFormat: 'yy-mm-dd'}).val();
	LoadDiskon();
})


$(document).on('click','#cekdiskonmanual',function(){
	$.ajax({
			url:'http://localhost:8000/CekDiskon',
			method:'GET',
			success:function(data){
				sessionStorage.setItem('session_diskon','tercek');
				LoadDiskon();
				LoadStock();
			}
		})
})


 $(document).on('click','.SupplierEdit',function(){
 	var id=$(this).attr('id');
 	$.ajax({
 		url:'SupplierEdit/'+id,
 		method:'GET',
 		success:function(data){
 			$('#SupplierLoadModal').html(data);
 		}
 	})
 })

 $(document).on('click','.UserEdit',function(){
 	var id=$(this).attr('id');
 	$.ajax({
 		url:'UserEdit/'+id,
 		method:'GET',
 		success:function(data){
 			$('#UserLoadModal').html(data);
 		}
 	})
 })

 $(document).on('click','.StokEdit',function(){
 	var id=$(this).attr('id');
 	$.ajax({
 		url:'StokEdit/'+id,
 		method:'GET',
 		success:function(data){
 			$('#StokLoadModal').html(data);
 		}
 	})
 })

 $(document).on('click','.ShowStok',function(){
 	var id=$(this).attr('id');
 	$.ajax({
 		url:'/ShowStok/'+id,
 		method:'GET',
 		success:function(data){
 			alert('Stok barang: '+data);
 		}
 	})
 })

 $(document).on('change','.qtyc',function(){
 	var id=$(this).attr('id');
 	if ($('#pagination').val()=='Scanning') {
	 		$.ajax({
	 		url:'/ShowStok/'+id,
	 		method:'GET',
	 		success:function(data){
	 			$('.qty'+id).attr('max',data);
				var cekqty=parseInt($('.qty'+id).val());
	 			if (data<parseInt(cekqty)) {
	 				alert('stok hanya :'+data);
	 				$('.qty'+id).val(data);
	 			}else{
	 				$('.qty'+id).val(cekqty);

	 			}
				 	var qty=$('.qty'+id).val();
				 	if (qty=='') {
				 		$('.qty'+id).val('1');
				 		qty=1;
				 	}
				 	var hargacart=$('#hargacart'+id).val();
				 	var disc1=$('.disc1k'+id).val();
				 	var disc2=$('.disc2k'+id).val();
				 	var discnominal=$('.discnominal'+id).val();
				 	hitung(id,qty,hargacart,disc1,disc2,discnominal);
				 	var subtotal=$('#subtotal'+id).val();
					CartUpdate(id,qty,disc1,disc2,discnominal,subtotal);
					$('.rupiah').autoNumeric('init',{

				aDec:',',
				aSep:'.'
					});
	 		}
	 	})
 	}else if ($('#pagination').val()=='Pembelian') {
			 		var qty=$('.qty'+id).val();
			 		if (qty=='') {
				 		$('.qty'+id).val('1');
				 		qty=1;
				 	}
				 	var hargacart=$('#hargacart'+id).val();
				 	var disc1=$('.disc1k'+id).val();
				 	var disc2=$('.disc2k'+id).val();
				 	var discnominal=$('.discnominal'+id).val();
				 	hitung(id,qty,hargacart,disc1,disc2,discnominal);
				 	var subtotal=$('#subtotal'+id).val();
					CartUpdate(id,qty,disc1,disc2,discnominal,subtotal);
					$('.rupiah').autoNumeric('init',{

				aDec:',',
				aSep:'.'
					});

 	}
 })

 $(document).on('keyup','.qtyc',function(){
 	var id=$(this).attr('id');
 	if ($('#pagination').val()=='Scanning') {
	 		$.ajax({
	 		url:'/ShowStok/'+id,
	 		method:'GET',
	 		success:function(data){
	 			$('.qty'+id).attr('max',data);
				var cekqty=parseInt($('.qty'+id).val());
	 			if (data<parseInt(cekqty)) {
	 				alert('stok hanya :'+data);
	 				$('.qty'+id).val(data);
	 			}else{
	 				$('.qty'+id).val(cekqty);

	 			}
				 	var qty=$('.qty'+id).val();
				 	$('.qty'+id).val(qty);
				 	var hargacart=$('#hargacart'+id).val();
				 	var disc1=$('.disc1k'+id).val();
				 	var disc2=$('.disc2k'+id).val();
				 	var discnominal=$('.discnominal'+id).val();
				 	hitung(id,qty,hargacart,disc1,disc2,discnominal);
				 	var subtotal=$('#subtotal'+id).val();
					CartUpdate(id,qty,disc1,disc2,discnominal,subtotal);
					$('.rupiah').autoNumeric('init',{

				aDec:',',
				aSep:'.'
					});
	 		}
	 	})
 	}else if ($('#pagination').val()=='Pembelian') {
			 		var qty=parseInt($('.qty'+id).val());
				 	$('.qty'+id).val(qty);
				 	var hargacart=$('#hargacart'+id).val();
				 	var disc1=$('.disc1k'+id).val();
				 	var disc2=$('.disc2k'+id).val();
				 	var discnominal=$('.discnominal'+id).val();
				 	hitung(id,qty,hargacart,disc1,disc2,discnominal);
				 	var subtotal=$('#subtotal'+id).val();
					CartUpdate(id,qty,disc1,disc2,discnominal,subtotal);
					$('.rupiah').autoNumeric('init',{

				aDec:',',
				aSep:'.'
					});

 	}

 })

 $(document).on('keyup','.d1c',function(){
 	var id=$(this).attr('id');
 	var qty=parseInt($('.qty'+id).val());
 	var hargacart=parseInt($('#hargacart'+id).val());
 	var disc1=parseInt($('.disc1k'+id).val());
 	$('.disc1k'+id).val(disc1);
 	if (isNaN(disc1)) {
 		$('.disc1k'+id).val('0');
 		disc1=0;
 	}
 	var disc2=parseInt($('.disc2k'+id).val());
 	var discnominal=parseInt($('.discnominal'+id).val());
 	hitung(id,qty,hargacart,disc1,disc2,discnominal);
	CartUpdate(id,qty,disc1,disc2,discnominal,subtotal);
 	var subtotal=parseInt($('#subtotal'+id).val());
	
 })

 $(document).on('keyup','.d2c',function(){
 	var id=$(this).attr('id');
 	var qty=parseInt($('.qty'+id).val());
 	var hargacart=parseInt($('#hargacart'+id).val());
 	var disc1=parseInt($('.disc1k'+id).val());
 	var disc2=parseInt($('.disc2k'+id).val());
 	$('.disc2k'+id).val(disc2);
 	if (isNaN(disc2)) {
 		$('.disc2k'+id).val('0');
 		disc2=0;
 	}
 	var discnominal=parseInt($('.discnominal'+id).val());
 	hitung(id,qty,hargacart,disc1,disc2,discnominal);
 	var subtotal=parseInt($('#subtotal'+id).val());
	CartUpdate(id,qty,disc1,disc2,discnominal,subtotal);
	
 })

 $(document).on('keyup','.dnc',function(){
 	var id=$(this).attr('id');
 	var qty=parseInt($('.qty'+id).val());
 	var hargacart=parseInt($('#hargacart'+id).val());
 	var disc1=parseInt($('.disc1k'+id).val());
 	var disc2=parseInt($('.disc2k'+id).val());
 	var discnominal=parseInt($('.discnominal'+id).val());
 	$('.discnominal'+id).val(discnominal);
 	if (isNaN(discnominal)) {
 		$('.discnominal'+id).val('0');
 		discnominal=0;
 	}
 	hitung(id,qty,hargacart,disc1,disc2,discnominal);
 	var subtotal=parseInt($('#subtotal'+id).val());
	CartUpdate(id,qty,disc1,disc2,discnominal,subtotal);
	
 })

 $(document).on('change','.d1c',function(){
 	var id=$(this).attr('id');
 	var qty=parseInt($('.qty'+id).val());
 	var hargacart=parseInt($('#hargacart'+id).val());
 	var disc1=parseInt($('.disc1k'+id).val());
 	$('.disc1k'+id).val(disc1);
 	var disc2=parseInt($('.disc2k'+id).val());
 	var discnominal=parseInt($('.discnominal'+id).val());
 	hitung(id,qty,hargacart,disc1,disc2,discnominal);
 	var subtotal=parseInt($('#subtotal'+id).val());
	CartUpdate(id,qty,disc1,disc2,discnominal,subtotal);
	
 })

 $(document).on('change','.d2c',function(){
 	var id=$(this).attr('id');
 	var qty=parseInt($('.qty'+id).val());
 	var hargacart=parseInt($('#hargacart'+id).val());
 	var disc1=parseInt($('.disc1k'+id).val());
 	var disc2=parseInt($('.disc2k'+id).val());
 	$('.disc2k'+id).val(disc2);
 	var discnominal=parseInt($('.discnominal'+id).val());
 	hitung(id,qty,hargacart,disc1,disc2,discnominal);
 	var subtotal=parseInt($('#subtotal'+id).val());
	CartUpdate(id,qty,disc1,disc2,discnominal,subtotal);
	
 })

 $(document).on('change','.dnc',function(){
 	var id=$(this).attr('id');
 	var qty=parseInt($('.qty'+id).val());
 	var hargacart=parseInt($('#hargacart'+id).val());
 	var disc1=parseInt($('.disc1k'+id).val());
 	var disc2=parseInt($('.disc2k'+id).val());
 	var discnominal=parseInt($('.discnominal'+id).val());
 	$('.discnominal'+id).val(discnominal);
 	hitung(id,qty,hargacart,disc1,disc2,discnominal);
 	var subtotal=parseInt($('#subtotal'+id).val());
	CartUpdate(id,qty,disc1,disc2,discnominal,subtotal);
	
 })
 
$(document).on('keyup','#disc3k',function(){
 	hitung2();
 	
 })

$(document).on('keyup','#discnominal2',function(){
 	hitung2();
 	
 })

$(document).on('keyup','#debit',function(){
 	hitung3();
 	
 })

$(document).on('keyup','#tunai',function(){
 	hitung3();
 	
 })

$(document).on('keyup','#money',function(){
 	hitung3();
 	
 })
 
 $(document).on('click','.laporan',function(){
 	var id=$(this).attr('id');
 	$('#SubPagination').val(id);
 	if (id=='subpembelian') {
 		$('#subpembelianf').show();
 		$(this).css({"border":"1px solid #28a785","padding":"2px"});
 		$('#subpenjualan').css({"border":"0"});
 		$('#subhutang').css({"border":"0"});
 		$('#subabsen').css({"border":"0"});
 		$('#subuntung').css({"border":"0"});
 	}else if (id=='subpenjualan') {
 		$('#subpenjualanf').show();
 		$(this).css({"border":"1px solid #28a785","padding":"2px"});
 		$('#subpembelian').css({"border":"0"});
 		$('#subhutang').css({"border":"0"});
 		$('#subabsen').css({"border":"0"});
 		$('#subuntung').css({"border":"0"});
 	}else if (id=='subhutang') {
 		$('#subhutangf').show();
 		$(this).css({"border":"1px solid #28a785","padding":"2px"});
 		$('#subpembelian').css({"border":"0"});
 		$('#subpenjualan').css({"border":"0"});
 		$('#subabsen').css({"border":"0"});
 		$('#subuntung').css({"border":"0"});
 	}else if (id=='subabsen') {
 		$('#tampilabsen').show();
 		$(this).css({"border":"1px solid #28a785","padding":"2px"});
 		$('#subpembelian').css({"border":"0"});
 		$('#subpenjualan').css({"border":"0"});
 		$('#subhutang').css({"border":"0"});
 		$('#subuntung').css({"border":"0"});
 	}else if (id=='subuntung') {
 		$('#tampiluntung').show();
 		$(this).css({"border":"1px solid #28a785","padding":"2px"});
 		$('#subpembelian').css({"border":"0"});
 		$('#subpenjualan').css({"border":"0"});
 		$('#subhutang').css({"border":"0"});
 		$('#subabsen').css({"border":"0"});
 	}
 	LoadSubPagination();
	$('.rupiah').autoNumeric('init',{
	aDec:',',
	aSep:'.'
	});


 })
 
 $(document).on('click','.staff',function(){
 	var id=$(this).attr('id');
 	if (id=='subabsen') {
 		$('#SubPagination').val('subabsen');
 		$('#tampilabsen').show();
 		$(this).css({"border":"1px solid #28a785","padding":"2px"});
 		$('#substaffbaru').css({"border":"0"});
 	}else if (id=='substaffbaru') {
 		$('#SubPagination').val('substaffbaru');
 		$('#tampiltambahstaff').show();
 		$(this).css({"border":"1px solid #28a785","padding":"2px"});
 		$('#subabsen').css({"border":"0"});
 		LoadKaryawan();
 	}
 	LoadSubPagination();
 })


 $(document).on('click','#PostLaporanPembelian',function(){
 	LaporanPembelianLoad();
 })

  $(document).on('click','#PostLaporanPenjualan',function(){
 	LaporanPenjualanLoad();
 })

 $(document).on('click','#PostPelunasan',function(){
 	Pelunasan();
 })

  $(document).on('click','#PostHutang',function(){
 	HutangLoad();
 })

$(document).on('click','#PostLaporanAbsen',function(){
 	LaporanAbsensiLoad();
 })

$(document).on('click','#PostLaporanUntung',function(){
 	LaporanUntungLoad();
 })

$(document).on('click','#editbarang',function(){
	EditBarang();
 })

$(document).on('click','.editdiskons',function(){
	var id=$(this).attr('id');
	var kodebarang=$('#kodebarangs'+id).val();
	$('#iddiskon').val(id);
	$('#kodebarang').html(kodebarang);
	$('#kodebarangx').val(kodebarang);
	$('#tanggalmulai').datepicker({dateFormat: 'yy-mm-dd'}).val();
	$('#tanggalakhir').datepicker({dateFormat: 'yy-mm-dd'}).val();

})

$(document).on('click','#editdiskon',function(){
	EditDiskon();
 })


$(document).on('click','#editsupplier',function(){
	EditSupplier();
 })

$(document).on('click','#edituser',function(){
	EditUser();
 })

$(document).on('keyup','.search',function(){
	var search=$(this).val();
	var sub=$('#SubPagination').val();
	$.ajax({
		url:'/Search',
		data:'sub='+sub+'&search='+search,
		method:'GET',
		success:function(data){
			if (sub=='subbarang') {
				$('#StokLoad').html(data);
			}else if (sub=='subsupplier') {
				$('#SupplierLoad').html(data);
			}else if (sub=='substaffbaru') {
				$('#KaryawanLoad').html(data);
			}
			CekPosisi();
		}
	})
})

$(document).on('keyup','.search2',function(){
	var search=$(this).val();
	$.ajax({
		url:'/Search',
		data:'search='+search+'&sub=subdiskon',
		method:'GET',
		success:function(data){
			$('#DiskonLoad').html(data);
			CekPosisi();
		}
	})
})

 $(document).on('click','.collapselaporan',function(){
 	var id=$(this).attr('id');
 	$.ajax({
 		url:'CollapseLaporanBeli/'+id,
 		method:'GET',
 		success:function(data){
 			$('#DetailTransaksiBeli').html(data);
 			$('#DetailTransaksiBelis').html(data);
			$('.rupiah').autoNumeric('init',{

		aDec:',',
		aSep:'.'
			});
 		}
 	})
 })

 $(document).on('click','.collapselaporanjual',function(){
 	var id=$(this).attr('id');
 	$.ajax({
 		url:'CollapseLaporanj/'+id,
 		method:'GET',
 		success:function(data){
 			$('#DetailTransaksij').html(data);
 			$('#DetailTransaksijs').html(data);

			$('.rupiah').autoNumeric('init',{
			aDec:',',
			aSep:'.'
			});
 		}
 	})
 })

 $(document).on('change','#pembayaran',function(){
 	var value=$(this).val();
 	if (value=='Hutang') {
 		$('#pehutangan').show();
 	}else if(value=='Lunas'){
 		$('#PelunasanSelect').show();
 		$('#pehutangan').hide();

 	}

	$('.rupiah').autoNumeric('init',{
	aDec:',',
	aSep:'.'
	});
 })

$(document).on('click','.idmodal',function(){
	var id=$(this).attr('id');
	$('#getidmodal').val(id);
	var tanggal1=$( '#tanggal1' ).datepicker({dateFormat: 'yy-mm-dd'}).val(); 
})


$(document).on('click','.detilpelunasanbayar',function(){
	var id=$(this).attr('id');
	$.ajax({
		url:'detilpelunasanbayar/'+id,
		method:'GET',
		success:function(data){
			$('#showtanggalbayar').html(data);
			$('#showtanggalbayar2').html(data);
			$('.rupiah').autoNumeric('init',{

		aDec:',',
		aSep:'.'
			});
		}
	})
})

$(document).on('click','#PostAbsen',function(){
	var nama=$('#iduser').val();
	var tanggal=$( '#tanggal1' ).datepicker({dateFormat: 'yy-mm-dd'}).val(); 
	var waktu=$('#jam').wickedpicker().val();
	waktu = waktu.replace(' : ', ' ');
	var h = waktu.split(' ')[0];
	var m = waktu.split(' ')[1];
	var staff=$('#staff').val();
	waktu=h+':'+m;
	$.ajax({
		url:'PostAbsen',
		data:'nama='+nama+'&tanggal='+tanggal+'&waktu='+waktu+'&staff='+staff,
		method:'GET',
		success:function(){
			AbsenLoad();
		}
	})
	
})

function AbsenLoad() {
	$.ajax({
		url:'AbsenLoad',
		method:'GET',
		success:function(data){
			$('#AbsenLoad').html(data);
		}
	})
}

function uang(nilai) {
	var	number_string = nilai.toString(),
	sisa 	= number_string.length % 3,
	rupiah 	= number_string.substr(0, sisa),
	ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
	if (ribuan) {
	separator = sisa ? '.' : '';
	rupiah += separator + ribuan.join('.');
}

// Cetak hasil
return rupiah;
}

$(document).on('click','.btndelete',function(){
	var id=$(this).attr('id');
	var a=$('#idntndelete').attr('href','/StokDelete/'+id);
})


function grand1() {
	var s=0;
	$('.grandjual').each(function(){
		var a=$(this).val();
		s +=parseInt(a);
	});
	$('#grandjual').val(s);
	$('#grandjualt').html(uang(s));
}

function grand2() {
	var s=0;
	$('.grandbeli').each(function(){
		var a=$(this).val();
		s +=parseInt(a);
	});
	$('#grandbeli').val(s);
	$('#grandbelit').html(uang(s));
}

function grand3(){
	var a=parseInt($('#grandbeli').val());
	var b=parseInt($('#grandjual').val());
	var rumus=b-a;
	$('#granduntungt').html(uang(rumus));

}

// $(document).on('focus','input', function(){
// 	var input=$(this);
// 	$(document).on('click','.keypad',function(){
// 		var keypad=$(this).attr('id');
// 		var isi=input.val()
// 		input.val(isi+keypad);
// 	})
// });

$(document).on('keypress',function(e) {

    	var kode=$('#kode2').val();
		var pagination=$('#pagination').val();
    if (e.keyCode==47) {
		if (pagination=='Scanning') {
			if (kode!='') {
			$.ajax({
				url:'/CartPost/'+kode,
				method:'GET',
				success:function(data){
					LoadCart2(kode);
			 		$('#kodex').val('');
			 		$('#kode2').val('');
				}
			})
		 }
		}else{
			if (kode!='') {
			$.ajax({
				url:'/CartBeliPost/'+kode,
				method:'GET',
				success:function(data){
					LoadCart2(kode);
			 		$('#kodex').val('');
			 		$('#kode2').val('');
				}
			})
		}
		}
	}
});


$(document).on('keypress',function(e) {
    if (e.keyCode==42) {
    	$('#kodex').focus();
	}
});


$(document).on('keypress',function(e) {
    if (e.keyCode==46) {
    	$('input').blur();
    	LoadCart();
	}
});


$(document).on('click','#butload',function(e) {
    	$('input').blur();
    	LoadCart();
});
