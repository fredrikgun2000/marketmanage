<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;
use Redirect;
use Session;
use App\User;
use App\StatusKaryawan;
use App\Jenis;
use App\Stok;
use App\Supplier;
use App\Cart;
use App\CartBeli;
use App\CartPenjual;
use App\TransaksiJual;
use App\TransaksiBeli;
use App\Pelunasan;
use App\Absen;

//get
class MainController extends Controller
{
    public function LoginIndex()
    {
    	return view('Login.index');
    }

    public function Logout()
	{
		Session::flush();
        return redirect('/');
	}

    public function LaporanIndex()
    {
        $datajenis=Jenis::all();
        $datasupplier=Supplier::all();
        $datapenjual=User::all();
        $dataadmin=User::where('posisi','admin')->get();
    	return view('Laporan.index',['datajenis'=>$datajenis,'datasupplier'=>$datasupplier,'datapenjual'=>$datapenjual,'dataadmin'=>$dataadmin]);
    }

     public function KaryawanIndex()
    {
        $data=User::all();
    	return view('Karyawan.index',['datastaff'=>$data]);
    }

     public function StokIndex()
    {	
    	return view('Stok.index');
    }

     public function ScanningIndex()
    {
        $data=User::all();
    	return view('Scanning.index',['datakaryawan'=>$data]);
    }

     public function PembelianIndex()
    {
        $data=Supplier::all();
        return view('Pembelian.index',['datasupplier'=>$data]);
    }

     public function PelunasanIndex()
    {
        $data=Supplier::all();
        return view('Pelunasan.index',['datasupplier'=>$data]);
    }

//post
    public function LoginPost(Request $request)
    {
    	$namapengguna=$request['namapengguna'];
    	$katasandi=$request['katasandi'];

    	$data=User::where('namapengguna',$namapengguna)->first();
    	if ($data!=null) {
    		if (hash::check($katasandi,$data['katasandi'])) {
                Session::put('namapengguna',$data['namapengguna']);
    			Session::put('posisi',$data['posisi']);
                Session::put('id',$data['id']);
    			Session::put('Login','true');
    			return redirect('/Scanning');
    		}else{
    			return Redirect()->back()->with(['messagesandi'=>'kata sandi anda salah']);
    		}
    	}else{
    			return Redirect()->back()->with(['messagenama'=>'nama pengguna anda salah']);
    	}
    }

    public function KaryawanPost(Request $request)
    {
    	$namapengguna=$request['namapengguna'];
    	$katasandi=hash::make($request['katasandi']);
    	$posisi=$request['posisi'];

    	 $validator=request()->validate([
           'namapengguna' => 'required',
           'katasandi' => 'required',
           'posisi' => 'required'
        ],
        [
        	'required'=>':attribute anda harus mengisi kolom ini'
        ]
    );
        $data=array(
        	'namapengguna'=>$namapengguna,
        	'katasandi'=>$katasandi,
        	'posisi'=>$posisi,
        	'pekerjastatus'=>'bekerja',
        );
    	user::create($data);
    	return Response()->JSON(['msg'=>'data berhasil di input']);

    }

    public function JenisFormPost(Request $request)
    {
    	$jenis=$request['jenis'];
    	Jenis::create(['jenis'=>$jenis]);
    	return back();

    }

    public function StokPost(Request $request)
    {
    	$kode=$request['kode'];
    	$nama=$request['nama'];
    	$hargabeli=$request['hargabeli'];
    	$hargajual=$request['hargajual'];
    	$jenis=$request['jenis'];
    	$satuan=$request['satuan'];

        $data2=Stok::where('kode',$kode)->first();
        if ($data2==null) {
            $data=array(
                'kode'=>$kode,
                'nama'=>$nama,
                'hargabeli'=>$hargabeli,
                'hargajual'=>$hargajual,
                'jenis'=>$jenis,
                'stok'=>0,
                'satuan'=>$satuan,
            );
        	Stok::create($data);
            return Response()->JSON(['msg'=>'data berhasil di input']);
        }else{
        	return Response()->JSON(['err'=>'Kode Sudah Ada']);
        }
    	

    }

    public function SupplierPost(Request $request)
    {
        $nama=$request['nama'];
        $telepon=$request['telepon'];

        $data=array(
            'nama'=>$nama,
            'telepon'=>$telepon,
        );
        Supplier::create($data);
        return Response()->JSON(['msg'=>'data berhasil di input']);

    }

    public function CartPost($kode)
    {
    	$data2=Stok::where('kode',$kode)->first();
    	$data3=Cart::where(
    		array(
    			'kode'=>$kode,
	    		'transaksi'=>'',
    		)
    	)->first();
    	if ($data3=='') { 
    		if ($data2!='') {
    		$data=array(
    		'transaksi'=>'',
    		'kode'=>$kode,
    		'qty'=>1,
    		'hargacart'=>$data2['hargajual'],
    		'disc1'=>0,
    		'disc2'=>0,
            'discnominal'=>0,
            'modaltotal'=>$data2['hargabeli'],
    		'subtotal'=>$data2['hargajual'],
            'untung'=>$data2['hargajual']-$data2['hargabeli']
    	);
    	Cart::create($data);
    	}else{
    		return Response()->JSON('kode salah');
    	}
    	}
    }

 public function CartBeliPost($kode)
    {
        $data2=Stok::where('kode',$kode)->first();
        $data3=CartBeli::where(
            array(
                'kode'=>$kode,
                'transaksi'=>'',
            )
        )->first();
        if ($data3=='') { 
            if ($data2!='') {
            $data=array(
            'transaksi'=>'',
            'kode'=>$kode,
            'qty'=>1,
            'hargacartbeli'=>$data2['hargabeli'],
            'disc1'=>0,
            'disc2'=>0,
            'discnominal'=>0,
            'subtotal'=>$data2['hargabeli'],
        );
        CartBeli::create($data);
        }else{
            return Response()->JSON('kode salah');
        }
        }
    }

    public function PenjualanPost(Request $request)
    {  
        $tanggalpost=$request['tanggalpost'];
        $qty=$request['qty'];
        $kode=$request['kode'];
        $penjual='kosong';
        $subtotalt=$request['subtotalt'];
        $disc1t=$request['disc1t'];
        $discnominalt=$request['discnominalt'];
        $grandtotal=$request['grandtotal'];
        $metode=$request['metode'];
        $tunai=$request['tunai'];
        $debit=$request['debit'];
        $money=$request['money'];

        $datamodal=Cart::where('transaksi','')->sum('modaltotal');
        $datauntung=Cart::where('transaksi','')->sum('untung');

        if ($penjual!='Pilih Penjual') {
              if ($tunai!=0) {
            $tunaihasil='tunai,';
        }else{
            $tunaihasil='';

        }
        if ($debit!=0) {
            $debithasil='debit,';
        }else{
            $debithasil='';

        }
        if ($money!=0) {
            $moneyhasil='E-Money';
        }else{
            $moneyhasil='';

        }
        if ($tunai+$debit+$money<$grandtotal) {
             return back()->with('message', 'Jumlah Yang Dibayarkan Tidak Cukup');
        }

        $data=TransaksiJual::all()->count();
        $data2=array(
            'notransaksi'=>$data+1,
            'tanggal'=>$tanggalpost,
            'penjual'=>$penjual,
            'subtotalt'=>$subtotalt,
            'disc1t'=>$disc1t,
            'discnominalt'=>$discnominalt,
            'modaltotalcart'=>$datamodal,
            'grandtotal'=>$grandtotal,
            'untungtotal'=>$datauntung,
            'metode'=>$tunaihasil.$debithasil.$moneyhasil
        );
        $this->Print($tanggalpost,$subtotalt,$disc1t,$discnominalt);
        $k=0;
        while($k<count($qty)){
            Stok::where('kode',$kode[$k])->decrement('stok', $qty[$k]);
            $k++;
        }    
        TransaksiJual::create($data2);
        $l=0;
        while($l<count($kode)){
        Cart::where(array('kode'=>$kode[$l],'transaksi'=>''))->update(['transaksi'=>$data+1]);
            $l++;
        }
        return back();
          }else{
             return back()->with('message', 'Harap Isi Nama Karyawan');         
          }
    }

    public function PembelianPost(Request $request)
    {  
        $tanggalpost=$request['tanggalpost'];
        $qty=$request['qty'];
        $kode=$request['kode'];
        $penjual=$request['supplier'];
        $subtotalt=$request['subtotalt'];
        $disc1t=$request['disc1t'];
        $discnominalt=$request['discnominalt'];
        $grandtotal=$request['grandtotal'];
        $metode=$request['metode'];
        $pembayaran=$request['pembayaran'];
        $tempo=$request['tempo'];
        $tunai=$request['tunai'];
        $debit=$request['debit'];
        $money=$request['money'];

        if ($penjual!='Pilih Supplier') {
            if ($tunai!=0) {
            $tunaihasil='tunai,';
        }else{
            $tunaihasil='';
        }
        if ($debit!=0) {
            $debithasil='debit,';
        }else{
            $debithasil='';
        }
        if ($money!=0) {
            $moneyhasil='E-Money';
        }else{
            $moneyhasil='';

        }
        if ($pembayaran=='Lunas') {
            $tanggalbayar=$tanggalpost;
        }else if($pembayaran=='Hutang'){
            $tanggalbayar='';
        }
        if ($tunai+$debit+$money<$grandtotal) {
            $pembayaran='Hutang';
            $pelunasan=$tunai+$debit+$money;
            $tanggalbayar=$tanggalpost;
            if (empty($tempo)) {
                return back()->with('message', 'Anda Tidak Membayar Penuh Silakan Masukan Jatuh Tempo');
            }
        }
        if (empty($tempo)) {
            $tempo='';
        }
        $pelunasan=$tunai+$debit+$money;

        $data=TransaksiBeli::all()->count();
        $data2=array(
            'notransaksi'=>$data+1,
            'tanggal'=>$tanggalpost,
            'supplier'=>$penjual,
            'subtotalt'=>$subtotalt,
            'disc1t'=>$disc1t,
            'discnominalt'=>$discnominalt,
            'grandtotal'=>$grandtotal,
            'metode'=>$tunaihasil.$debithasil.$moneyhasil,
            'pembayaran'=>$pembayaran,
            'tempo'=>$tempo,
            'pelunasan'=>$pelunasan,
            'tanggalbayar'=>$tanggalbayar
        );
        $k=0;
        while($k<count($qty)){
            Stok::where('kode',$kode[$k])->increment('stok', $qty[$k]);
            $k++;
        }    
        TransaksiBeli::create($data2);
        $l=0;
        while($l<count($kode)){
        CartBeli::where(array('kode'=>$kode[$l],'transaksi'=>''))->update(['transaksi'=>$data+1]);
            $l++;
        }
        Pelunasan::create(['transaksi'=>$data+1,'tanggalbayar'=>$tanggalpost,'totalbayar'=>$pelunasan,'sisa'=>$grandtotal-$pelunasan]);
        return back();
        }else {
             return back()->with('message', 'Harap Isi Supplier');
        }
          
    }

    public function PelunasanTPost(Request $request)
    {
       $id=$request['idmodal'];
       $total=$request['total'];
       $data=TransaksiBeli::where('notransaksi',$id)->first();
       $data2=$data['grandtotal']-$data['pelunasan']-$total;
       $data3=$data['pelunasan']+$total;
       $tanggal=$request['tanggalpost'];
       if ($data2==0) {
           TransaksiBeli::where('notransaksi',$id)->update(['pelunasan'=>$data3,'pembayaran'=>'Lunas']);
           Pelunasan::create(['transaksi'=>$id,'tanggalbayar'=>$tanggal,'totalbayar'=>$total,'sisa'=>$data2]);
       }else{
           TransaksiBeli::where('notransaksi',$id)->update(['pelunasan'=>$data3,'tanggalbayar'=>$tanggal]);
           Pelunasan::create(['transaksi'=>$id,'tanggalbayar'=>$tanggal,'totalbayar'=>$total,'sisa'=>$data2]);
       }
       return back();
    }

//eksekusi data
    public function KaryawanLoad()
    {
    	$data=User::all();
    	return view('karyawan.load',['KaryawanLoad'=>$data]);
    }

    public function StokLoad()
    {
        $data=Stok::orderBy('id','DESC')->get();
    	return view('Stok.load',['StokLoad'=>$data]);
    }

    public function SupplierLoad()
    {
        $data=Supplier::all();
        return view('Stok.supplierload',['SupplierLoad'=>$data]);
    }

 	public function CartLoad()
 	{
 		$data =DB::table('stok')
		    ->select('*')
		    ->join('cart', 'stok.kode', '=', 'cart.kode')
		    ->where(array(
		    	'cart.transaksi'=>'',
		    ))->orderBy('cart.id','DESC')->get();
 		return view('Scanning.loadcart',['CartLoad'=>$data]);
 	}

    public function CartBeliLoad()
    {
        $data =DB::table('stok')
            ->select('*')
            ->join('cartbeli', 'stok.kode', '=', 'cartbeli.kode')
            ->where(array(
                'cartbeli.transaksi'=>'',
            ))->orderBy('cartbeli.id','DESC')->get();
        return view('Pembelian.loadcart',['CartLoad'=>$data]);
    }

 	public function ShowBarangIndex()
 	{
        $datajenis=jenis::all();
 		$datasupplier=Supplier::all();
 		return view('Stok.showbarang',['datajenis'=>$datajenis,'datasupplier'=>$datasupplier]);
 	}

 	public function ShowSupplierIndex()
 	{
 		return view('Stok.showsupplier');
 	}

    public function LaporanPenjualanLoad(Request $request)
    {
        $kode=$request['kode'];
        $tanggal1=$request['tanggal1'];
        $tanggal2=$request['tanggal2'];
        $barang=$request['barang'];
        $transaksi=$request['transaksi'];
        $jenis=$request['jenis'];
        
         $data=TransaksiJual::query()
        ->join('cart', 'cart.transaksi', '=', 'transaksijual.notransaksi');
        if (!empty($kode)) {
              $data = $data->where('kode', 'like', '%'.$kode.'%');
        }
        if (!empty($tanggal1) AND empty($tanggal2)) {
              $data = $data->where('tanggal',$tanggal1);
        }
        if (!empty($tanggal2) AND empty($tanggal1)) {
              $data = $data->where('tanggal',$tanggal2);
        }
        if (!empty($tanggal1 AND $tanggal2)) {
              $data = $data->whereBetween('tanggal',[$tanggal1,$tanggal2]);
        }
        if (!empty($penjual)) {
              $data = $data->where('penjual', 'like', '%'.$penjual.'%');
        }
        if (!empty($jenis)) {
              $data = $data->where('jenis', 'like', '%'.$jenis.'%');
        }
        if (!empty($pembayaran)) {
              $data = $data->where('pembayaran', 'like', '%'.$pembayaran.'%');
        }
         if (!empty($transaksi)) {
              $data = $data->where('notransaksi', 'like', '%'.$transaksi.'%');
        }
        $data = $data->orderBy('transaksijual.id','DESC')->get();
        return view('Laporan.penjualanload',['datalaporan'=>$data]);

    }

      public function LaporanPembelianLoad(Request $request)
    {
        $kode=$request['kode'];
        $tanggal1=date($request['tanggal1']);
        $tanggal2=date($request['tanggal2']);
        $supplier=$request['supplier'];
        $jenis=$request['jenis'];
        $transaksi=$request['transaksi'];
        $pembayaran='Lunas';
        
        $data=TransaksiBeli::query()
        ->join('cartbeli', 'cartbeli.transaksi', '=', 'transaksibeli.notransaksi');
        if (!empty($kode)) {
              $data = $data->where('kode', 'like', '%'.$kode.'%');
        }
        if (!empty($tanggal1) AND empty($tanggal2)) {
              $data = $data->where('tanggal',$tanggal1);
        }
        if (!empty($tanggal2) AND empty($tanggal1)) {
              $data = $data->where('tanggal',$tanggal2);
        }
        if (!empty($tanggal1 AND $tanggal2)) {
              $data = $data->whereBetween('tanggal',[$tanggal1,$tanggal2]);
        }
        if (!empty($supplier)) {
              $data = $data->where('supplier', 'like', '%'.$supplier.'%');
        }
        if (!empty($jenis)) {
              $data = $data->where('jenis', 'like', '%'.$jenis.'%');
        }
        if (!empty($pembayaran)) {
              $data = $data->where('pembayaran', 'like', '%'.$pembayaran.'%');
        }
        if (!empty($transaksi)) {
              $data = $data->where('transaksi', 'like', '%'.$transaksi.'%');
        }
        $data = $data->orderBy('transaksibeli.id','DESC')->get();
        return view('Laporan.pembelianload',['datalaporan'=>$data]);
    }

    public function Pelunasan(Request $request)
    {
        $transaksi=$request['transaksi'];
        $tanggal1=date($request['tanggal1']);
        $tanggal2=date($request['tanggal2']);
        $tanggal3=date($request['tanggal3']);
        $tanggal4=date($request['tanggal4']);
        $supplier=$request['supplier'];
        $pembayaran='Hutang';
        
        $data=TransaksiBeli::query()
        ->join('cartbeli', 'cartbeli.transaksi', '=', 'transaksibeli.notransaksi');
        if (!empty($transaksi)) {
              $data = $data->where('transaksi', 'like', '%'.$transaksi.'%');
        }
        if (!empty($tanggal1) AND empty($tanggal2)) {
              $data = $data->where('tanggal',$tanggal1);
        }
        if (!empty($tanggal2) AND empty($tanggal1)) {
              $data = $data->where('tanggal',$tanggal2);
        }
        if (!empty($tanggal3) AND empty($tanggal4)) {
              $data = $data->where('tempo',$tanggal3);
        }
        if (!empty($tanggal4) AND empty($tanggal3)) {
              $data = $data->where('tempo',$tanggal4);
        }
        if (!empty($tanggal1 AND $tanggal2)) {
              $data = $data->whereBetween('tanggal',[$tanggal1,$tanggal2]);
        }
        if (!empty($tanggal3 AND $tanggal4)) {
              $data = $data->whereBetween('tempo',[$tanggal3,$tanggal4]);
        }
        if (!empty($supplier)) {
              $data = $data->where('supplier', 'like', '%'.$supplier.'%');
        }
        if (!empty($pembayaran)) {
              $data = $data->where('pembayaran', 'like', '%'.$pembayaran.'%');
        }
        $data = $data->orderBy('transaksibeli.id','DESC')->get();
        return view('Pelunasan.load',['datapelunasan'=>$data]);
    }

    public function Hutang(Request $request)
    {
        $transaksi=$request['transaksi'];
        $tanggal1=date($request['tanggal1']);
        $tanggal2=date($request['tanggal2']);
        $tanggal3=date($request['tanggal3']);
        $tanggal4=date($request['tanggal4']);
        $supplier=$request['supplier'];
        $pembayaran='Hutang';
        
        $data=TransaksiBeli::query()
        ->join('cartbeli', 'cartbeli.transaksi', '=', 'transaksibeli.notransaksi');
        if (!empty($transaksi)) {
              $data = $data->where('transaksi', 'like', '%'.$transaksi.'%');
        }
        if (!empty($tanggal1) AND empty($tanggal2)) {
              $data = $data->where('tanggal',$tanggal1);
        }
        if (!empty($tanggal2) AND empty($tanggal1)) {
              $data = $data->where('tanggal',$tanggal2);
        }
        if (!empty($tanggal3) AND empty($tanggal4)) {
              $data = $data->where('tempo',$tanggal3);
        }
        if (!empty($tanggal4) AND empty($tanggal3)) {
              $data = $data->where('tempo',$tanggal4);
        }
        if (!empty($tanggal1 AND $tanggal2)) {
              $data = $data->whereBetween('tanggal',[$tanggal1,$tanggal2]);
        }
        if (!empty($tanggal3 AND $tanggal4)) {
              $data = $data->whereBetween('tempo',[$tanggal3,$tanggal4]);
        }
        if (!empty($supplier)) {
              $data = $data->where('supplier', 'like', '%'.$supplier.'%');
        }
        if (!empty($pembayaran)) {
              $data = $data->where('pembayaran', 'like', '%'.$pembayaran.'%');
        }
        $data = $data->orderBy('transaksibeli.id','DESC')->get();
        return view('Laporan.hutangload',['datapelunasan'=>$data]);
    }

       public function LaporanAbsensiLoad(Request $request)
    {
        $tanggal1=date($request['tanggal1']);
        $tanggal2=date($request['tanggal2']);
        $admin=$request['admin'];
        $staff=$request['staff'];

        $data=Absen::query();
        if (!empty($tanggal1) AND empty($tanggal2)) {
              $data = $data->where('tanggal',$tanggal1);
        }
        if (!empty($tanggal2) AND empty($tanggal1)) {
              $data = $data->where('tanggal',$tanggal2);
        }
        if (!empty($tanggal1 AND $tanggal2)) {
              $data = $data->whereBetween('tanggal',[$tanggal1,$tanggal2]);
        }
        if (!empty($staff)) {
              $data = $data->where('staff', $staff);
        }
        if (!empty($admin)) {
              $data = $data->where('pengabsen',$admin);
        }
        $data = $data->orderBy('id','DESC')->get();
        return view('Karyawan.absenload',['dataabsen'=>$data]);
    }

     public function LaporanUntungLoad(Request $request)
    {
        $tanggal1=date($request['tanggal1']);
        $tanggal2=date($request['tanggal2']);

        $data=TransaksiBeli::query();
        if (!empty($tanggal1 AND $tanggal2)) {
              $data = $data->whereBetween('tanggal',[$tanggal1,$tanggal2]);
        }
        $data = $data->orderBy('id','DESC')->get();

        $data2=TransaksiJual::query();
        if (!empty($tanggal1 AND $tanggal2)) {
              $data2 = $data2->whereBetween('tanggal',[$tanggal1,$tanggal2]);
        }
        $data2 = $data2->orderBy('id','DESC')->get();

        return view('Laporan.untungload',['datauntungjual'=>$data,'datauntungbeli'=>$data2]);
    }
    //eksekusi data2
    public function EditSupplier($id)
    {
        $data=Supplier::where('id',$id)->get();
        return view('Stok.modalsupplier',['EditSupplier'=>$data]);
    }

    public function EditUser($id)
    {
        $data=User::where('id',$id)->get();
        return view('Karyawan.modal',['EditUser'=>$data]);
    }

     public function SupplierUpdate(Request $request)
    {
        $id=$request['id'];
        $nama=$request['nama'];
        $telepon=$request['telepon'];

        $data=array(
            'nama'=>$nama,
            'telepon'=>$telepon,
        );
        Supplier::where('id',$id)->update($data);
        return Response()->JSON(['msg'=>'data berhasil di input']);

    }

    public function UserUpdate(Request $request)
    {
        $id=$request['id'];
        $nama=$request['nama'];
        $sandi=$request['sandi'];
        $posisi=$request['posisi'];

        $data=array(
            'namapengguna'=>$nama,
            'katasandi'=>hash::make($sandi),
            'posisi'=>$posisi,
        );
        User::where('id',$id)->update($data);
        return Response()->JSON(['msg'=>'data berhasil di input']);

    }


    public function DeleteSupplier($id)
    {
        Supplier::where('id',$id)->delete();
        return back();
    }

    public function DeleteUser($id)
    {
        User::where('id',$id)->delete();
        return back();
    }

    public function DeleteAbsen($id)
    {
        Absen::where('id',$id)->delete();
        return back();
    }

     public function EditStok($id)
    {
        $data=Stok::where('id',$id)->get();
        $datajenis=jenis::all();
        $datasupplier=Supplier::all();
        return view('Stok.modalbarang',['EditStok'=>$data,'datajenis'=>$datajenis,'datasupplier'=>$datasupplier]);
    }

     public function StokUpdate(Request $request)
    {
        $id=$request['id'];
        $kode=$request['kode'];
        $nama=$request['nama'];
        $hargabeli=$request['hargabeli'];
        $hargajual=$request['hargajual'];
        $jenis=$request['jenis'];
        $satuan=$request['satuan'];

        $data=array(
            'kode'=>$kode,
            'nama'=>$nama,
            'hargabeli'=>$hargabeli,
            'hargajual'=>$hargajual,
            'jenis'=>$jenis,
            'satuan'=>$satuan,
        );
        Stok::where('id',$id)->update($data);
        return Response()->JSON($id);

    }

    public function DeleteStok($id)
    {
        Stok::where('id',$id)->delete();
        return back();
    }

    public function CartUpdate($id,$qty,$disc1,$disc2,$discnominal,$subtotal)
    {
        $data=Stok::where('kode',$id)->first()['hargabeli'];
        $data3=Stok::where('kode',$id)->first()['hargajual'];
        $data2=($data3*$qty-$data*$qty);
        Cart::where(array(
            'kode'=>$id,
            'transaksi'=>''
        ))->update(
            array(
                'qty'=>$qty,
                'disc1'=>$disc1,
                'disc2'=>$disc2,
                'discnominal'=>$discnominal,
                'modaltotal'=>$data*$qty,
                'subtotal'=>$subtotal,
                'untung'=>$data2
            )
        );

        return Response()->JSON('berhasil update');
    }

    public function CartBeliUpdate($id,$qty,$disc1,$disc2,$discnominal,$subtotal)
    {
        CartBeli::where(array(
            'kode'=>$id,
            'transaksi'=>''
        ))->update(
            array(
                'qty'=>$qty,
                'disc1'=>$disc1,
                'disc2'=>$disc2,
                'discnominal'=>$discnominal,
                'subtotal'=>$subtotal
            )
        );
        return Response()->JSON('berhasil update');
    }


    public function DeleteCart($id)
    {
        Cart::where(array(
            'kode'=>$id,
            'transaksi'=>''
        ))->delete();
        return back();
    }

    public function DeleteCartBeli($id)
    {
        CartBeli::where(array(
            'kode'=>$id,
            'transaksi'=>''
        ))->delete();
        return back();
    }

    public function ShowStok($id)
    {
        return Response()->JSON(Stok::where('kode',$id)->first()['stok']);
    }

    public function CollapseLaporanBeli($id)
    {
        $data=$data =DB::table('stok')
            ->select('*')
            ->join('cartbeli', 'stok.kode', '=', 'cartbeli.kode')
            ->where(array(
                'cartbeli.transaksi'=>$id,
            ))->orderBy('cartbeli.id','DESC')->get();
        return view('Laporan.detaillaporanbeli',['datacart'=>$data]);
    }

    public function CollapseLaporanJual($id)
    {
        $data=$data =DB::table('stok')
            ->select('*')
            ->join('cart', 'stok.kode', '=', 'cart.kode')
            ->where(array(
                'cart.transaksi'=>$id,
            ))->orderBy('cart.id','DESC')->get();
        return view('Laporan.detaillaporanjual',['datacart'=>$data]);
    }

    public function detilpelunasanbayar($id)
    {
        $data=Pelunasan::where('transaksi',$id)->get();
        return view('Laporan.detailpelunasan',['datapelunasan'=>$data]);
    }

    public function PostAbsen(Request $request)
    {
        $nama=$request['nama'];
        $tanggal=$request['tanggal'];
        $waktu=$request['waktu'];
        $staff=$request['staff'];
        $data=array(
            'tanggal'=>$tanggal,
            'waktu'=>$waktu,
            'staff'=>$staff,
            'pengabsen'=>$nama,
        );
        Absen::create($data);
        return Response()->JSON('oke');
    }

    public function AbsenLoad()
    {
        $data=Absen::where('tanggal',date('Y-m-d'))->orderBy('id','DESC')->get();
        return view('Karyawan.absenload',['dataabsen'=>$data]);
    }

    public function AbsenLoad2()
    {
        $data=Absen::all();
        return view('Karyawan.absenload',['dataabsen'=>$data]);
    }

    public function Search(Request $request)
    {
        $sub=$request['sub'];
        $search=$request['search'];
        if ($sub=='subbarang') {
            $data=Stok::where('nama','like', '%'.$search.'%')->orWhere('kode','like', '%'.$search.'%')->orWhere('jenis','like', '%'.$search.'%')->orWhere('satuan','like', '%'.$search.'%')->get();
            return view('Stok.load',['StokLoad'=>$data]);
        }elseif ($sub=='subsupplier') {
            $data=Supplier::where('nama','like', '%'.$search.'%')->get();
            return view('Stok.supplierload',['SupplierLoad'=>$data]);
        }elseif ($sub=='substaffbaru') {
            $data=User::where('namapengguna','like', '%'.$search.'%')->get();
            return view('Karyawan.load',['KaryawanLoad'=>$data]);
        }
    }

    public function UntungTerakhir()
    {
        $data=TransaksiBeli::where('tanggal', '>=', '2020-10-01')->count();
        $k='';
         while($k<count($data)){
            Stok::where('kode',$kode[$k])->decrement('stok', $qty[$k]);
            $k++;
        }   
        return $data;
    }

    public function Print($tanggalpost,$subtotalt,$disc1t,$discnominalt)
    {
        // Set params
        $store_name='Dunia Kita';
        $store_address='Jln transkalimantan ruko mitra keluarga';
        $store_phone='x';
        $tax_percentage = $subtotalt*($disc1t/100)+$discnominalt;
        $notransaksi=TransaksiJual::all()->count()+1;
        
        // Set items
        $items =DB::table('stok')
            ->select('*')
            ->join('cart', 'stok.kode', '=', 'cart.kode')
            ->where(array(
                'cart.transaksi'=>'',
            ))->get();

        // Init printer
        $printer = new ReceiptPrinter;
        $printer->init(
            config('receiptprinter.connector_type'),
            config('receiptprinter.connector_descriptor')
        );

        // Set store info
        $printer->setStore($store_name, $store_address,$notransaksi, $store_phone);

        // Add items
        foreach ($items as $item) {
            $printer->addItem(
                $item->nama,
                $item->qty,
                $item->hargacart,
                $item->disc1,
                $item->disc2,
                $item->discnominal,
                $item->subtotal
            );
        }
        
        // Calculate total
        $printer->calculateSubTotal($subtotalt);
        $printer->setTax($tax_percentage);
        $printer->calculateGrandTotal($disc1t,$discnominalt);
      
        // Set transaction ID

        $printer->setTransactionID($notransaksi);

        // Print receipt
        $printer->printReceipt();
    }
}
