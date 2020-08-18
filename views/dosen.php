<?php
	// include models/model_dosen.php
	include "models/model_dosen.php";

	$dsn = new Dosen($connection);

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
									<h3 class="panel-title">Data Dosen</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-bordered table-hover table-striped" id="datatables">
											<thead>
												<tr>
													<th>No.</th>
													<th>Nip</th>
													<th>Nama Dosen</th>
													<th>Matkul</th>
													<th>Opsi</th>
												</tr>
											</thead>
											<tbody>
												<!-- tampil data dosen -->
												<?php
													$no = 1;
													$tampil = $dsn->tampil();
													while($data = $tampil->fetch_object()) {
												?>
												<tr>
													<td><?php echo $no++."."; ?></td>
													<td><?php echo $data->Nip; ?></td>
													<td><?php echo $data->Nama_dosen; ?></td>
													<td><?php echo $data->matkul; ?></td>
													<td>
														<!-- button edit dengan jquery ajax -->
														<a id="edit_dsn" data-toggle="modal" data-target="#edit" data-id="<?php echo $data->id_dosen; ?>" data-Nip="<?php echo $data->Nip; ?>" data-Nama="<?php echo $data->Nama_dosen; ?>" data-matkul="<?php echo $data->matkul; ?>">
															<button class="btn btn-info btn-xs"><i class="lnr lnr-pencil"></i></button></a>
														<!-- end button edit dengan jquery ajax -->
														<!-- button hapus -->
														<a href="?page=dosen&act=del&id=<?php echo $data->id_dosen; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
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
											<h4 class="modal-title">Tambah Data Dosen</h4>
										</div>
										<form action="" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="form-group">
													<label class="control-label" for="Nip">Nip</label>
													<input type="text" name="Nip" class="form-control" placeholder="Masukan nomor nip" id="Nip" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="Nama_dosen">Nama Dosen</label>
													<input type="text" name="Nama_dosen" class="form-control" placeholder="Masukan nama dosen" id="Nama_dosen" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="matkul">Mata Kuliah</label>
													<input type="text" name="matkul" class="form-control" placeholder="Masukan mata kuliah" id="matkul" required>
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
												$Nip = $connection->conn->real_escape_string($_POST['Nip']);
												$Nama_dosen = $connection->conn->real_escape_string($_POST['Nama_dosen']);
												$matkul = $connection->conn->real_escape_string($_POST['matkul']);
												if(@$_POST['tambah']) {
													$dsn->tambah($Nip, $Nama_dosen, $matkul);
													header("location: ?page=dosen"); // redirect ke form data dosen
												} else {
													echo "<script>alert('Tambah data dosen gagal!')</script>";
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
											<h4 class="modal-title">Edit Data Dosen</h4>
										</div>
										<form id="form" enctype="multipart/form-data">
											<div class="modal-body" id="modal-edit">
												<div class="form-group">
													<label class="control-label" for="Nip">Nip</label>
													<!-- id setiap data armada untuk parameter edit -->
													<input type="hidden" name="id_dosen" id="id_dosen">
													<input type="text" name="Nip" class="form-control" placeholder="Masukan nomor nip" id="Nip" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="Nama_dosen">Nama Dosen</label>
													<input type="text" name="Nama_dosen" class="form-control" placeholder="Masukan nama dosen" id="Nama_dosen" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="matkul">Mata kuliah</label>
													<input type="text" name="matkul" class="form-control" placeholder="Masukan mata kuliah" id="matkul" required>
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
									var id_dsn = $(this).data('id');
									var Nip_dsn = $(this).data('Nip');
									var nama_dsn = $(this).data('Nama_dosen');
									var matkul_dsn = $(this).data('matkul');
									$("#modal-edit #id_dosen").val(id_dsn);
									$("#modal-edit #Nip").val(Nip_dsn);
									$("#modal-edit #Nama_dosen").val(nama_dsn);
									$("#modal-edit #matkul").val(matkul_dsn);
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
		$dsn->hapus($_GET['id']);
		// redirect
		header("location: ?page=dosen");
	}
