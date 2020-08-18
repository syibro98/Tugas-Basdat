<?php
require('fpdf.php');
// koneksi database
include "../inc/koneksi.php";

$pdf = new FPDF();
$pdf->AddPage();

$pdf->Image('../assets/img/favicon.png',10,10,-200);
$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,5,'CV. Data','0','1','C',false);
$pdf->SetFont('Arial','i',10);
$pdf->Cell(0,5,'Alamat : Jln. Raya Belendung Subang Jawa Barat No. Telp : (0123)885808','0','1','C',false);
$pdf->Cell(0,2,'https://Data.com','0','1','C',false);
$pdf->Ln(3);
$pdf->Cell(190,0.6,'','0','1','C',true);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(45,5,'Laporan Data Dosen','0','1','C',false);
$pdf->Ln(3);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(8,6,'No.',1,0,'C');
$pdf->Cell(30,6,'Nip',1,0,'C');
$pdf->Cell(30,6,'Nama_dosen',1,0,'C');
$pdf->Cell(30,6,'matkul',1,0,'C');
$pdf->Ln(2);
$no = 0;
$sql = mysqli_query($koneksi, "SELECT * FROM tb_dosen ORDER BY id_dosen ASC");
while($data = mysqli_fetch_array($sql)) {
	$no++;
	$pdf->Ln(4);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(8,4,$no.".",1,0,'C');
	$pdf->Cell(30,4,$data['Nip'],1,0,'L');
	$pdf->Cell(30,4,$data['Nama_dosen'],1,0,'L');
	$pdf->Cell(30,4,$data['matkul'],1,0,'L');
}

$pdf->Output();

?>