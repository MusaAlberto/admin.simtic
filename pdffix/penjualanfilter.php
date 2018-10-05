<?php
	$angka = $_GET['bulan'];
	$tahun = $_GET['tahun'];
	$title = 'DATA PENJUALAN JAMUR TIRAM';
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
			
			$this->Cell(15,5,'KODE',1,0,'',true);
			$this->Cell(25,5,'TANGGAL',1,0,'',true);
			$this->Cell(25,5,'NAMA',1,0,'',true);
			$this->Cell(20,5,'ALAMAT',1,0,'',true);
			$this->Cell(30,5,'JENIS PEMBELI',1,0,'',true);
			$this->Cell(30,5,'JENIS JAMUR',1,0,'',true);
			$this->Cell(20,5,'TERJUAL',1,0,'',true);
			$this->Cell(25,5,'TOTAL',1,1,'',true);
			
			
			
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
	$query = mysqli_query($conn,"SELECT apl_penjualan.kode_akun as kode, apl_penjualan.kode_akun as kode, apl_penjualan.Nama_Pembeli as nama,  apl_penjualan.Alamat as alamat, apl_penjualan.Id_Penjualan as id, apl_jenispembeli.Jenis_Pembeli as pembeli, apl_jenisjamur.Jenis_Jamur as jamur, apl_penjualan.Jumlahjamurterjual as jumlah, apl_penjualan.Tanggal_Penjualan as tanggal , apl_penjualan.Total_Pemasukan as total from apl_penjualan, apl_jenispembeli, apl_jenisjamur WHERE apl_penjualan.Id_Jenispembeli = apl_jenispembeli.Id_Jenispembeli AND apl_jenisjamur.Id_Jenisjamur = apl_penjualan.Id_Jenisjamur AND Month(apl_penjualan.Tanggal_Penjualan)='$angka' AND YEAR(apl_penjualan.Tanggal_Penjualan)='$tahun'");
	while($data=mysqli_fetch_array($query)){
		$pdf->Cell(15,5,$data['kode'],1,0);
		$pdf->Cell(25,5,$data['tanggal'],1,0);
		$pdf->Cell(25,5,$data['nama'],1,0);
		$pdf->Cell(20,5,$data['alamat'],1,0);
		$pdf->Cell(30,5,$data['pembeli'],1,0);
		$pdf->Cell(30,5,$data['jamur'],1,0);
		$pdf->Cell(20,5,$data['jumlah'].' Kg',1,0);
		$pdf->Cell(25,5,'Rp. '.$data['total'].',00',1,1);					
	}
	
	$query2 = "SELECT sum(Total_Pemasukan) as jumlah FROM `apl_penjualan` WHERE YEAR(Tanggal_Penjualan)='$tahun' AND MONTH(Tanggal_Penjualan)='$angka'";
	$sql2 = mysqli_query($conn,$query2);
	while($data2 = mysqli_fetch_array($sql2)){
		$jumlah = $data2['jumlah'];
	}
	$pdf->Cell(165,5,'TOTAL',1,0);
	$pdf->Cell(25,5,'Rp. '.$jumlah.',00',1,0);
	
	
	$pdf->Output("penjualanfilter.pdf","D");
	
	
?>