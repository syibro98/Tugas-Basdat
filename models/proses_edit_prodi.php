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
	$prd = new Prodi($connection);

	$id_prodi = $_POST['id_prodi'];
	$Nama_prodi = $connection->conn->real_escape_string($_POST['Nama_prodi']);

	$prd>edit("UPDATE tb_prodi SET id_prodi = '$id_prodi', Nama_prodi = '$Nama_prodi' WHERE id_dosen = '$id_dosen'");
	// redirect
	echo "<script>window.location='?page=prodi';</script>";
?>