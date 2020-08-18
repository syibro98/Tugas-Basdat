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
	include "../models/model_dosen.php";
	$dsn = new Dosen($connection);

	$id_dosen = $_POST['id_dosen'];
	$Nip = $connection->conn->real_escape_string($_POST['Nip']);
	$Nama_dosen = $connection->conn->real_escape_string($_POST['Nama_dosen']);
	$matkul = $connection->conn->real_escape_string($_POST['matkul']);

	$dsn>edit("UPDATE tb_dosen SET Nip = '$Nip', Nama_dosen = '$Nama_dosen', matkul = '$matkul' WHERE id_dosen = '$id_dosen'");
	// redirect
	echo "<script>window.location='?page=dosen';</script>";
?>