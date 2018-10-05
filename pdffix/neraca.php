<?php


$bulan = date('m');
$tahun = date('Y');

if ($bulan=="01"){
	$angka = 'Januari';
}
else if ($bulan=="02"){
	$angka = 'Februari';
}
else if ($bulan=="03"){
	$angka = 'Maret';
}
else if ($bulan=="04"){
	$angka = 'April';
}
else if ($bulan=="05"){
	$angka = 'Mei';
}
else if ($bulan=="06"){
	$angka = 'Juni';
}
else if ($bulan=="07"){
	$angka = 'Juli';
}
else if ($bulan=="08"){
	$angka = 'Agustus';
}
else if ($bulan=="09"){
	$angka = 'September';
}
else if ($bulan=="10"){
	$angka = 'Oktober';
}
else if ($bulan=="11"){
	$angka = 'November';
}
else if ($bulan=="12"){
	$angka = 'December';
}


include "../../apl_koneksi.php";
$query = "SELECT sum(Jumlah) as jumlah FROM `apl_pemasukanlain` WHERE YEAR(apl_pemasukanlain.Tanggal)=$tahun AND MONTh(apl_pemasukanlain.Tanggal)=$bulan";
$sql = mysqli_query($conn,$query);
while($data = mysqli_fetch_array($sql)){
		$jumlah = $data['jumlah'];
}

$query2 = "SELECT sum(Total_Pemasukan) as jumlah FROM `apl_penjualan` WHERE YEAR(apl_penjualan.Tanggal_Penjualan)=$tahun AND MONTh(apl_penjualan.Tanggal_Penjualan)=$bulan";
$sql2 = mysqli_query($conn,$query2);
while($data2 = mysqli_fetch_array($sql2)){
		$jumlah2 = $data2['jumlah'];
}

$in = $jumlah+$jumlah2;

$query3 = "SELECT sum(Total_Gaji) as jumlah FROM `apl_penggajian` WHERE Bulan='$angka' AND Tahun=$tahun AND Status_Pengambilan=1";
$sql3 = mysqli_query($conn,$query3);
while($data3 = mysqli_fetch_array($sql3)){
		$jumlah3 = $data3['jumlah'];
}

$query4 = "SELECT sum(Total_Gaji) as jumlah FROM `apl_penggajian` WHERE Bulan='$angka' AND Tahun=$tahun AND Status_Pengambilan=0";
$sql4 = mysqli_query($conn,$query4);
while($data4 = mysqli_fetch_array($sql4)){
		$jumlah4 = $data4['jumlah'];
}


$query5 = "SELECT sum(Total_Pembelian) as jumlah FROM `apl_pembelian` WHERE YEAR(apl_pembelian.Tanggal_Beli)=$tahun AND MONTh(apl_pembelian.Tanggal_Beli)=$bulan";
$sql5 = mysqli_query($conn,$query5);
while($data5 = mysqli_fetch_array($sql5)){
		$jumlah5 = $data5['jumlah'];
}
$out = $jumlah3+$jumlah5;

							$pemasukan = $jumlah+$jumlah2;
							$pengeluaran = $jumlah5+$jumlah3;
							$utang = $jumlah4;
							
							$out = $pengeluaran + $utang;
							
							if($pemasukan>$out){
								$kondisi = "LABA";
								$besar = $pemasukan - $out;
							}
							else if($pemasukan<$out){
								$kondisi = "RUGI";
								$besar = $out - $pemasukan;
								
							}
							else
							{
								$kondisi = "SEIMBANG";
								$besar = 0;
							}
						  







	$title = 'NERACA LABA RUGI USAHA BULAN INI';
	require('fpdf.php');
	include "apl_koneksi.php";
	$tanggal = date('d-m-Y H:i:s');
	
	class PDF extends FPDF{
		function garis(){
				
		}
		
		function Header(){
			$this->SetFont('Arial','B',12);
			$this->Cell(12);
			$this->Image('logo.png',10,10,10);
			$this->Cell(100,10,'Sistem Akuntansi dan Monitoring Budidaya Jamur Tiram ( ANTING )',0,1);
			

			$this->SetFont('Arial','',10);
			$this->Cell(12);
			$this->Cell(100,1,'Tanggal cetak : '.date('d-m-Y'),0,1);
			$this->SetLineWidth(1);
			$this->Line(10,24,200,24);
			$this->SetLineWidth(0);
			$this->Line(10,25,200,25);
			
			$this->Ln(10);
			global $title;
			$this->SetFont('Arial','B',15);
			$w = $this->GetStringWidth($title)+6;
			$this->SetX((210-$w)/2);
			
			
			$this->SetTextColor(230,230,0);
			$this->SetLineWidth(1);
			$this->Cell($w,9,$title,1,1,'C',true);
			$this->Ln(5);
	
			
			
			$this->SetFont('Arial','B',9);
			
			$this->Cell(190,5,'NERACA LABA RUGI',1,1,'',true);
			
			
			
			
		}
		
		function Footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page'.$this->PageNo()."/{pages}",0,0,'C');
			
		}	
	}
	
	
	
	$pdf = new PDF('p','mm','A4');
	
			
	
	$pdf->AliasNbPages('{pages}');
	$pdf->AddPage();
	$pdf->SetFont('Arial','',9);
	$pdf->SetDrawColor(50,50,100);
	
	
	$query2 = "SELECT sum(Jumlah) as jumlah FROM `apl_pemasukanlain`";
	$sql2 = mysqli_query($conn,$query2);
	while($data2 = mysqli_fetch_array($sql2)){
		$jumlah = $data2['jumlah'];
	}
	
	$pdf->Cell(190,5,'RINCIAN PEMASUKAN',1,1);
	$pdf->Cell(95,5,'PENJUALAN JAMUR',1,0);
	$pdf->Cell(95,5,'Rp. '.$jumlah2.',00',1,1);
	$pdf->Cell(95,5,'PEMASUKAN LAIN',1,0);
	$pdf->Cell(95,5,'Rp. '.$jumlah.',00',1,1);
	$pdf->Cell(95,5,'TOTAL PEMASUKAN',1,0);
	$pdf->Cell(95,5,'Rp. '.$in.',00',1,1);
	

	$pdf->Cell(190,5,'RINCIAN PENGELUARAN',1,1);
	$pdf->Cell(95,5,'PENGGAJIAN KARYAWAN',1,0);
	$pdf->Cell(95,5,'Rp. '.$jumlah3.',00',1,1);
	$pdf->Cell(95,5,'PEMBELIAN BAHAN DAN ALAT PRODUKSI',1,0);
	$pdf->Cell(95,5,'Rp. '.$jumlah5.',00',1,1);
	$pdf->Cell(95,5,'TOTAL PENGELUARAN',1,0);
	$pdf->Cell(95,5,'Rp. '.$out.',00',1,1);
	
	$pdf->Cell(190,5,'RINCIAN UTANG',1,1);
	$pdf->Cell(95,5,'BEBAN GAJI',1,0);
	$pdf->Cell(95,5,'Rp. '.$jumlah4.',00',1,1);
	
	$pdf->Cell(190,5,'USAHA',1,1);
	$pdf->Cell(95,5,'KONDISI',1,0);
	$pdf->Cell(95,5,$kondisi,1,1);
	$pdf->Cell(95,5,'BESAR',1,0);
	$pdf->Cell(95,5,'Rp. '.$besar.',00',1,1);
	
	
	
	
	
	
	
	$pdf->Output("neraca.pdf","D");
	
	
	
?>