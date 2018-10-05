<?php
	$kat=$_GET['id'];
	$title = 'Hasil Tes TOEIC';
	require('fpdf.php');
	include "apl_koneksi.php";
	$tanggal = date('d-m-Y H:i:s');
	
	class PDF extends FPDF{
		function Header(){
			$this->Image('logo.jpg',10,10,190);
			// Line break
    		$this->Ln(35);
		}
		
		function Footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page'.$this->PageNo()."/{pages}",0,0,'C');
		}	

		function headerTable(){
			$this->SetFont('Arial','B',9);
			$this->Cell(15,5,'Kode',1,0,'C');
			$this->Cell(50,5,'Nama Institusi',1,0,'C');
			$this->Cell(45,5,'Nama',1,0,'C');
			$this->Cell(20,5,'Tanggal Tes',1,0,'C');
			$this->Cell(15,5,'Kelas',1,0,'C');
			$this->Cell(17,5,'Listening',1,0,'C');
			$this->Cell(17,5,'Reading',1,0,'C');
			$this->Cell(11,5,'Skor',1,0,'C');
			$this->Ln();
		}
	}
	
	$pdf = new PDF('p','mm','A4');
	
			
	
	$pdf->AliasNbPages('{pages}');
	$pdf->AddPage();
	$pdf->headerTable();
	$pdf->SetFont('Arial','',9);

	$query = mysqli_query($conn,"SELECT *, tabel_peserta.nama as nama_peserta, tabel_jurusan.nama as nama_jurusan, tabel_prodi.nama as nama_prodi FROM tabel_peserta JOIN tabel_hasil ON tabel_peserta.kode_peserta = tabel_hasil.kode_auth LEFT JOIN tabel_jurusan ON tabel_peserta.jurusan = tabel_jurusan.id_jurusan LEFT JOIN tabel_prodi ON tabel_peserta.prodi = tabel_prodi.id_prodi WHERE tabel_peserta.level_user='$kat' AND tabel_hasil.jenis_tes='ujian' ORDER BY tgl_tes DESC");

	while($data=mysqli_fetch_array($query)){
		$val = $data['score_listening'] + $data['score_reading'];

		$pdf->Cell(15,5,$data['kode_peserta'],1,0,'C');
		$pdf->Cell(50,5,$data['nama_institusi'],1,0);
		$pdf->Cell(45,5,$data['nama_peserta'],1,0);
		$pdf->Cell(20,5,$data['tgl_tes'],1,0,'C');
		$pdf->Cell(15,5,$data['kelas'],1,0,'C');
		$pdf->Cell(17,5,$data['score_listening'],1,0,'C');
		$pdf->Cell(17,5,$data['score_reading'],1,0,'C');
		$pdf->Cell(11,5,$val,1,1,'C');			
	}
	
	
	$pdf->Output();
	
	
	
?>