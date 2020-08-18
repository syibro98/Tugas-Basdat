<?php
	// include models/model_dosen.php
	include "models/model_mahasiswa.php";

	$mhs = new Mahasiswa($connection);

	// untuk clean dan mengamankan parameter pada link browser
	if(@$_GET['act'] == '') {
?>
<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<!-- <div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Armada</h3>
							<p class="panel-subtitle">Selamat Datang, Admin</p>
						</div>
					</div> -->
							<!-- BORDERED TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Data Mahasiswa</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-bordered table-hover table-striped" id="datatables">
											<thead>
												<tr>
													<th>No.</th>
													<th>Nim</th>
													<th>Nama Mahasiswa</th>
													<th>TTL</th>
													<th>JK</th>
													<th>Alamat</th>
													<th>Opsi</th>
												</tr>
											</thead>
											<tbody>
												<!-- tampil data dosen -->
												<?php
													$no = 1;
													$tampil = $mhs->tampil();
													while($data = $tampil->fetch_object()) {
												?>
												<tr>
													<td><?php echo $no++."."; ?></td>
													<td><?php echo $data->Nim; ?></td>
													<td><?php echo $data->Nama_mahasiswa; ?></td>
													<td><?php echo $data->TTL; ?></td>
													<td><?php echo $data->JK; ?></td>
													<td><?php echo $data->Alamat; ?></td>
													<td>
														<!-- button edit dengan jquery ajax -->
														<a id="edit_dsn" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->id_mahasiswa; ?>" data-Nim="<?php echo $data->Nim; ?>" data-Nama="<?php echo $data->Nama_mahasiswa; ?>" data-TTL="<?php echo $data->TTL; ?>" data-JK="<?php echo $data->JK; ?>" data-Alamat="<?php echo $data->Alamat; ?>">
															<button class="btn btn-info btn-xs"><i class="lnr lnr-pencil"></i></button></a>
														<!-- end button edit dengan jquery ajax -->
														<!-- button hapus -->
														<a href="?page=mahasiswa&act=del&id=<?php echo $data->id_mahasiswa; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
															<button class="btn btn-danger btn-xs"><i class="lnr lnr-trash"></i></button></a>
														<!-- button hapus -->
													</td>
												</tr>
												<?php
													}
												?>
												<!-- end tampil data armada -->
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- END BORDERED TABLE -->

							<!-- button dan form pop up tambah data armada -->
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Data</button>
							<!-- model pop up tambah data armada -->
							<div id="tambah" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Tambah Data Mahasiswa</h4>
										</div>
										<form action="" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="form-group">
													<label class="control-label" for="Nim">Nim</label>
													<input type="text" name="Nim" class="form-control" placeholder="Masukan nomor nim" id="Nim" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="Nama_mahasiswa">Nama Mahasiswa</label>
													<input type="text" name="Nama_mahasiswa" class="form-control" placeholder="Masukan nama mahasiswa" id="Nama_mahasiswa" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="TTL">TTL</label>
													<input type="text" name="TTL" class="form-control" placeholder="Masukan Tempat Tanggal Lahir" id="TTL" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="JK">JK</label>
													<input type="text" name="JK" class="form-control" placeholder="Masukan jenis kelamin" id="JK" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="Alamat">Alamat</label>
													<input type="text" name="Alamat" class="form-control" placeholder="Masukan Alamat" id="Alamat" required>
												</div>
											</div>
											<div class="modal-footer">
												<button type="reset" class="btn btn-danger">Reset</button>
												<input type="submit" class="btn btn-success" name="tambah" value="Simpan">
											</div>
										</form>

										<!-- tambah data dosen -->
										<?php
											if(@$_POST['tambah']) {
												$Nim = $connection->conn->real_escape_string($_POST['Nim']);
												$Nama_mahasiswa = $connection->conn->real_escape_string($_POST['Nama_mahasiswa']);
												$TTL = $connection->conn->real_escape_string($_POST['TTL']);
												$JK = $connection->conn->real_escape_string($_POST['JK']);
												$Alamat = $connection->conn->real_escape_string($_POST['Alamat']);
												if(@$_POST['tambah']) {
													$mhs->tambah($Nim, $Nama_mahasiswa, $TTL, $JK, $Alamat);
													header("location: ?page=mahasiswa"); // redirect ke form data dosen
												} else {
													echo "<script>alert('Tambah data mahasiswa gagal!')</script>";
												}
											}
										?>
										<!-- end tambah data dosen -->
									</div>
								</div>
							</div>
							<!-- end button dan form pop up tambah data dosen -->


							<!-- model pop up edit data dosen -->
							<div id="edit" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Edit Data Mahasiswa</h4>
										</div>
										<form id="form" enctype="multipart/form-data">
											<div class="modal-body" id="modal-edit">
												<div class="form-group">
													<label class="control-label" for="Nim">Nim</label>
													<!-- id setiap data armada untuk parameter edit -->
													<input type="hidden" name="id_mahasiswa" id="id_mahasiswa">
													<input type="text" name="Nim" class="form-control" placeholder="Masukan nomor nim" id="Nim" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="Nama_mahasiswa">Nama Mahasiswa</label>
													<input type="text" name="Nama_mahasiswa" class="form-control" placeholder="Masukan nama mahasiswa" id="Nama_mahasiswa" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="TTL">TTL</label>
													<input type="text" name="TTL" class="form-control" placeholder="Masukan Tempat Tanggal Lahir" id="TTL" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="JK">JK</label>
													<input type="text" name="JK" class="form-control" placeholder="Masukan Jenis Kelamin" id="JK" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="Alamat">Alamat</label>
													<input type="text" name="Alamat" class="form-control" placeholder="Masukan Alamat" id="Alamat" required>
												</div>
											</div>
											<div class="modal-footer">
												<input type="submit" class="btn btn-success" name="edit" value="Simpan">
											</div>
										</form>
									</div>
								</div>
							</div>
							<!-- end model pop up edit data armada -->

							<!-- get data armada dengan jquery ajax -->
							<script src="assets/vendor/jquery/jquery.min.js"></script>
							<script type="text/javascript">
								// saat diklik dengan id #edit_amd
								$(document).on("click", "#edit_dsn", function() {
									var id_mhs = $(this).data('id');
									var Nim_mhs = $(this).data('Nim');
									var nama_mhs = $(this).data('Nama_mahasiswa');
									var TTL_mhs = $(this).data('TTL');
									var JK_mhs = $(this).data('JK');
									var Alamat_mhs = $(this).data('Alamat');
									$("#modal-edit #id_mahasiswa").val(id_mhs);
									$("#modal-edit #Nim").val(Nim_mhs);
									$("#modal-edit #Nama_mahasiswa").val(nama_mhs);
									$("#modal-edit #TTL").val(TTL_mhs);
									$("#modal-edit #JK").val(JK_mhs);
									$("#modal-edit #Alamat").val(Alamat_mhs);
								})

								// proses edit data dosen dengan jquery ajax
								$(document).ready(function(e) {
									$("#form").on("submit", (function(e) {
										e.preventDefault();
										$.ajax({
											url : 'models/proses_edit_dosen.php',
											type : 'POST',
											data : new FormData(this),
											contentType : false,
											cache : false,
											processData : false,
											success : function(msg) {
												$('.table').html(msg);
											}
										});
									}));
								})
							</script>

					<!-- END OVERVIEW -->
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
<!-- END MAIN -->
<?php
	} else if(@$_GET['act'] == 'del') {
		// echo "proses delete untuk id : ".$_GET['id'];
		$mhs->hapus($_GET['id']);
		// redirect
		header("location: ?page=dosen");
	}
