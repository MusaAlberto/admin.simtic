<?php
	$kat=$_GET['kat'];
	$title = 'DATA PEMASUKAN LAIN';
	require('fpdf.php');
	include "apl_koneksi.php";
	$tanggal = date('d-m-Y H:i:s');
	
	class PDF extends FPDF{
		
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
	

	$pdf->Cell(10,5,'No.',1,0,'',true);
	$pdf->Cell(30,5,'NIM.',1,0,'',true);
	$pdf->Cell(30,5,'Nama',1,0,'',true);
	$pdf->Cell(30,5,'Tangal Tes',1,0,'',true);
	$pdf->Cell(15,5,'Kelas',1,0,'',true);
	$pdf->Cell(30,5,'Listening',1,0,'',true);
	$pdf->Cell(30,5,'Reading',1,0,'',true);
	$pdf->Cell(15,5,'Skor',1,1,'',true);


	$query = mysqli_query($conn,"SELECT *, tabel_peserta.nama as nama_peserta, tabel_jurusan.nama as nama_jurusan, tabel_prodi.nama as nama_prodi FROM tabel_peserta JOIN tabel_hasil ON tabel_peserta.kode_peserta = tabel_hasil.kode_auth LEFT JOIN tabel_jurusan ON tabel_peserta.jurusan = tabel_jurusan.id_jurusan LEFT JOIN tabel_prodi ON tabel_peserta.prodi = tabel_prodi.id_prodi WHERE tabel_peserta.level_user = '$kat'");
	while($data=mysqli_fetch_array($query)){
		$pdf->Cell(10,5,$data['kode_peserta'],1,0);
		$pdf->Cell(30,5,$data['nim'],1,0);
		$pdf->Cell(30,5,$data['nama_peserta'],1,0);
		$pdf->Cell(30,5,$data['tgl_tes'],1,0);
		$pdf->Cell(15,5,$data['kelas'],1,0);
		$pdf->Cell(30,5,$data['score_listening'],1,0);
		$pdf->Cell(30,5,$data['score_reading'],1,0);
		$pdf->Cell(15,5,$data['score_listening'],1,1);			
	}
	
	
	$pdf->Output();
	
	
	
?>