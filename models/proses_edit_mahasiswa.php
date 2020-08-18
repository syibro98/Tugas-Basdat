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
	include "../models/model_mahasiswa.php";
	$dsn = new Dosen($connection);

	$id_mahasiswa = $_POST['id_mahasiswa'];
	$Nim = $connection->conn->real_escape_string($_POST['Nim']);
	$Nama_mahasiswa = $connection->conn->real_escape_string($_POST['Nama_mahasiswa']);
	$TTL = $connection->conn->real_escape_string($_POST['TTL']);
	$JK = $connection->conn->real_escape_string($_POST['JK']);
	$Alamat = $connection->conn->real_escape_string($_POST['Alamat']);

	$mhs>edit("UPDATE tb_mahasiswa SET Nim = '$Nim', Nama_mahasiswa = '$Nama_mahasiswa', TTL = '$TTL' JK = '$JK' Alamat = '$Alamat' WHERE id_mahasiswa = '$id_mahasiswa'");
	// redirect
	echo "<script>window.location='?page=mahasiswa';</script>";
?>