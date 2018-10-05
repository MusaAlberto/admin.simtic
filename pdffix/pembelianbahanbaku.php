<?php
	$title = 'DATA PEMBELIAN BAHAN BAKU';
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
			
			$this->Cell(20,5,'KODE',1,0,'',true);
			$this->Cell(30,5,'TANGGAL',1,0,'',true);
			$this->Cell(40,5,'NAMA BARANG',1,0,'',true);
			$this->Cell(20,5,'JUMLAH',1,0,'',true);
			$this->Cell(40,5,'HARGA SATUAN',1,0,'',true);
			$this->Cell(40,5,'TOTAL',1,1,'',true);
		
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
	$query = mysqli_query($conn,"SELECT * FROM `apl_pembelian`");
	while($data=mysqli_fetch_array($query)){
		$pdf->Cell(20,5,$data['kode_akun'],1,0);
		$pdf->Cell(30,5,$data['Tanggal_Beli'],1,0);
		$pdf->Cell(40,5,$data['Barang'],1,0);
		$pdf->Cell(20,5,$data['Jumlah'],1,0);
		$pdf->Cell(40,5,'Rp. '.$data['Harga_Satuan'].',00',1,0);	
		$pdf->Cell(40,5,'Rp. '.$data['Total_Pembelian'].',00',1,1);	
	}
	
	$query2 = "SELECT sum(Total_Pembelian) as jumlah FROM `apl_pembelian`";
	$sql2 = mysqli_query($conn,$query2);
	while($data2 = mysqli_fetch_array($sql2)){
		$jumlah = $data2['jumlah'];
	}
	$pdf->Cell(150,5,'TOTAL',1,0);
	$pdf->Cell(40,5,'Rp. '.$jumlah.',00',1,0);
	
	
	$pdf->Output("pembelian.pdf","D");
	
	
	
?>