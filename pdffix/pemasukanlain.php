<?php
	$title = 'DATA PEMASUKAN LAIN';
	require('fpdf.php');
	include "apl_koneksi.php";
	$tanggal = date('d-m-Y H:i:s');
	
	class PDF extends FPDF{
		
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
			
			$this->Cell(15,5,'LOGO',1,0,'',true);
			$this->Cell(30,5,'FORM HASIL TES PROFIENSI B. INGGRIS',1,0,'',true);
			$this->Cell(105,5,'NO. FPM',1,0,'',true);
			$this->Cell(40,5,'7.5.15/L1',1,1,'',true);

			$this->Cell(15,5,'LOGO',1,0,'',true);
			$this->Cell(30,5,'FORM HASIL TES PROFIENSI B. INGGRIS',1,0,'',true);
			$this->Cell(105,5,'REVISI',1,0,'',true);
			$this->Cell(40,5,'1',1,1,'',true);

			$this->Cell(15,5,'LOGO',1,0,'',true);
			$this->Cell(30,5,'TOEIC PREDICTION TEST RESULT',1,0,'',true);
			$this->Cell(105,5,'TANGGAL',1,0,'',true);
			$this->Cell(40,5,'1 Juli 2010',1,1,'',true);

			$this->Cell(15,5,'LOGO',1,0,'',true);
			$this->Cell(30,5,'UPT BAHASA POLITEKNIK NEGERI SEMARANG',1,0,'',true);
			$this->Cell(105,5,'Halaman',1,0,'',true);
			$this->Cell(40,5,'1 dari 1',1,1,'',true);
			
			
			
			
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
	$query = mysqli_query($conn,"SELECT * FROM `apl_pemasukanlain`");
	while($data=mysqli_fetch_array($query)){
		$pdf->Cell(15,5,$data['kode_akun'],1,0);
		$pdf->Cell(30,5,$data['Tanggal'],1,0);
		$pdf->Cell(105,5,$data['Pemasukan_Lain'],1,0);
		$pdf->Cell(40,5,'Rp. '.$data['Jumlah'].',00',1,1);			
	}
	
	$query2 = "SELECT sum(Jumlah) as jumlah FROM `apl_pemasukanlain`";
	$sql2 = mysqli_query($conn,$query2);
	while($data2 = mysqli_fetch_array($sql2)){
		$jumlah = $data2['jumlah'];
	}
	$pdf->Cell(150,5,'TOTAL',1,0);
	$pdf->Cell(40,5,'Rp. '.$jumlah.',00',1,0);
	
	
	$pdf->Output("pemasukanlain.pdf");
	
	
	
?>