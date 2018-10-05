<?php
	$title = 'DATA GAJI YANG SUDAH DIAMBIL';
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
			$this->SetFont('Arial','B',10);
			$w = $this->GetStringWidth($title)+6;
			$this->SetX((210-$w)/2);
			
			
			$this->SetTextColor(230,230,0);
			$this->SetLineWidth(1);
			$this->Cell($w,9,$title,1,1,'C',true);
			$this->Ln(5);
	
			
			
			$this->SetFont('Arial','B',9);
			
			$this->Cell(15,5,'KODE',1,0,'',true);
			$this->Cell(20,5,'BULAN',1,0,'',true);
			$this->Cell(15,5,'TAHUN',1,0,'',true);
			$this->Cell(20,5,'TANGGAL',1,0,'',true);
			$this->Cell(30,5,'KARYAWAN',1,0,'',true);
			$this->Cell(30,5,'JABATAN',1,0,'',true);
			$this->Cell(30,5,'BONUS',1,0,'',true);
			$this->Cell(30,5,'TOTAL',1,1,'',true);
			
			
			
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
	$query = mysqli_query($conn,"select apl_penggajian.kode_akun as kodeak, apl_penggajian.Id_Penggajian as kode, apl_karyawan.Nama as nama , apl_penggajian.Tanggal_Pengambilan as ambil, apl_posisi.Posisi as posisi,apl_penggajian.Bonus as bonus, apl_penggajian.Total_Gaji as total,apl_penggajian.Bulan as bulan,apl_penggajian.Tahun as tahun, apl_penggajian.Status_Pengambilan as status FROM apl_penggajian, apl_karyawan, apl_posisi WHERE apl_penggajian.Id_Karyawan = apl_karyawan.Id_Karyawan AND apl_karyawan.Id_Posisi = apl_posisi.Id_Posisi AND apl_penggajian.Status_Pengambilan=1");
	while($data=mysqli_fetch_array($query)){
		$pdf->Cell(15,5,$data['kodeak'],1,0);
		$pdf->Cell(20,5,$data['bulan'],1,0);
		$pdf->Cell(15,5,$data['tahun'],1,0);
		$pdf->Cell(20,5,$data['ambil'],1,0);
		$pdf->Cell(30,5,$data['nama'],1,0);
		$pdf->Cell(30,5,$data['posisi'],1,0);
		$pdf->Cell(30,5,'Rp. '.$data['bonus'].',00',1,0);
		$pdf->Cell(30,5,'Rp. '.$data['total'].',00',1,1);		
				
	}
	
	$query2 = "SELECT sum(Total_Gaji) as jumlah FROM `apl_penggajian` WHERE apl_penggajian.Status_Pengambilan=1 ";
	$sql2 = mysqli_query($conn,$query2);
	while($data2 = mysqli_fetch_array($sql2)){
		$jumlah = $data2['jumlah'];
	}
	$pdf->Cell(160,5,'TOTAL',1,0);
	$pdf->Cell(30,5,'Rp. '.$jumlah.',00',1,0);
	
	$pdf->Output("gajibayar.pdf","D");
	
	
	
?>