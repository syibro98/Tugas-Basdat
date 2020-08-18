<?php 
	class Mahasiswa {
		// deklasrasi objek/variabel
		private $mysqli;

		// fungsi yang otomatis diload pertama kali oleh kelas
		function __construct($conn) {
			$this->mysqli = $conn;
		}

		// fungsi tampil data dosen
		public function tampil($id = null) {
			$db = $this->mysqli->conn;
			$sql = "SELECT * FROM tb_mahasiswa";
			if($id != null) {
				$sql .= " WHERE id_mahasiswa = $id";
			}
			$query = $db->query($sql) or die ($db->error);
			return $query;
		}

		// fungsi tambah data armada
		public function tambah($Nim, $Nama_mahasiswa, $TTL, $JK, $Alamat) {
			$db = $this->mysqli->conn;
			$db->query("INSERT INTO tb_dosen VALUES('', '$Nim', '$Nama_mahasiswa', '$TTL', '$JK', '$Alamat')") or die ($db_error);
		}

		// fungsi edit data armada
		public function edit($sql) {
			$db = $this->mysqli->conn;
			$db->query($sql) or die ($db_error);
		}

		// fungsi hapus data armada
		public function hapus($id) {
			$db = $this->mysqli->conn;
			$db->query("DELETE FROM tb_mahasiswa WHERE id_mahasiswa = '$id'") or die ($db_error);
		}

		// fungsi yang otomatis dipanggil terakhir kali setelah semua fungsi dalam kelas dijalankan / penutup koneksi
		function __destruct() {
			$db = $this->mysqli->conn;
			$db->close();
		}
	}
?>