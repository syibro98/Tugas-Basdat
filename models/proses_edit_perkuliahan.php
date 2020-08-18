<?php
	// jquery ajax memerlukan pemanggilan semua koneksi
	// index.php
	// mencegah error saat redirect dengan fungsi header(location)
	ob_start();
	// include sekali controllers/koneksi.php dan models/database.php
	require_once('../controllers/koneksi.php');
	require_once('../models/database.php');
	$connection = new Database($host, $user, $pass, $database);

	// armada.php
	// include models/model_armada.php
	include "../models/model_perkuliahan.php";
	$dsn = new Dosen($connection);

	$id_perkuliahan = $_POST['id_perkuliahan'];
	$Nim = $connection->conn->real_escape_string($_POST['Nim']);
	$Nip = $connection->conn->real_escape_string($_POST['Nip']);
	$id_prodi = $connection->conn->real_escape_string($_POST['id_prodi']);
	$kelas = $connection->conn->real_escape_string($_POST['kelas']);
	$Nilai = $connection->conn->real_escape_string($_POST['Nilai']);

	$mhs>edit("UPDATE tb_perkuliahan SET Nim = '$Nim', Nip = '$Nip', id_prodi = '$id_prodi' Kelas = '$Kelas' Nilai = '$Nilai' WHERE id_perkuliahan = '$id_perkuliahan'");
	// redirect
	echo "<script>window.location='?page=perkuliahan';</script>";
?>