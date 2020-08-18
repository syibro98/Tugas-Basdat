<?php
	// include models/model_dosen.php
	include "models/model_perkuliahan.php";

	$pkl = new Perkuliahan($connection);

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
													<th>Nip</th>
													<th>Id prodi</th>
													<th>Kelas</th>
													<th>Nilai</th>
													<th>Opsi</th>
												</tr>
											</thead>
											<tbody>
												<!-- tampil data dosen -->
												<?php
													$no = 1;
													$tampil = $pkl->tampil();
													while($data = $tampil->fetch_object()) {
												?>
												<tr>
													<td><?php echo $no++."."; ?></td>
													<td><?php echo $data->Nim; ?></td>
													<td><?php echo $data->Nip; ?></td>
													<td><?php echo $data->id_prodi; ?></td>
													<td><?php echo $data->kelas; ?></td>
													<td><?php echo $data->Nilai; ?></td>
													<td>
														<!-- button edit dengan jquery ajax -->
														<a id="edit_pkl" data-toggle="modal" data-target="#edit" data-Nim="<?php echo $data->Nim; ?>" data-Nip="<?php echo $data->Nip; ?>" data-id="<?php echo $data->id_prodi; ?>" data-Kelas="<?php echo $data->kelas; ?>" data-Nilai="<?php echo $data->Nilai; ?>">
															<button class="btn btn-info btn-xs"><i class="lnr lnr-pencil"></i></button></a>
														<!-- end button edit dengan jquery ajax -->
														<!-- button hapus -->
														<a href="?page=perkuliahan&act=del&id=<?php echo $data->id_perkuliahan; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
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
											<h4 class="modal-title">Tambah Data Perkuliahan</h4>
										</div>
										<form action="" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<div class="form-group">
													<label class="control-label" for="Nim">Nim</label>
													<input type="text" name="Nim" class="form-control" placeholder="Masukan nomor nim" id="Nim" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="Nip">Nip</label>
													<input type="text" name="Nip" class="form-control" placeholder="Masukan nomor nip" id="Nip" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="id_prodi">Id Prodi</label>
													<input type="text" name="id_prodi" class="form-control" placeholder="Masukan id prodi" id="id_prodi" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="kelas">Kelas</label>
													<input type="text" name="kelas" class="form-control" placeholder="Masukan Kelas" id="kelas" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="Nilai">Nilai</label>
													<input type="text" name="Nilai" class="form-control" placeholder="Masukan Nilai" id="Nilai" required>
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
												$Nip = $connection->conn->real_escape_string($_POST['Nip']);
												$id_prodi = $connection->conn->real_escape_string($_POST['id_prodi']);
												$kelas = $connection->conn->real_escape_string($_POST['kelas']);
												$Nilai = $connection->conn->real_escape_string($_POST['Nilai']);
												if(@$_POST['tambah']) {
													$mhs->tambah($Nim, $Nip, $id_prodi, $Kelas, $Nilai);
													header("location: ?page=perkuliahan"); // redirect ke form data dosen
												} else {
													echo "<script>alert('Tambah data perkuliahan gagal!')</script>";
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
											<h4 class="modal-title">Edit Data Perkuliahan</h4>
										</div>
										<form id="form" enctype="multipart/form-data">
											<div class="modal-body" id="modal-edit">
												<div class="form-group">
													<label class="control-label" for="Nim">Nim</label>
													<!-- id setiap data armada untuk parameter edit -->
													<input type="hidden" name="id_perkuliahan" id="id_perkuliahan">
													<input type="text" name="Nim" class="form-control" placeholder="Masukan nomor nim" id="Nim" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="Nip">Nip</label>
													<input type="text" name="Nip" class="form-control" placeholder="Masukan nomor nip" id="Nip" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="id_prodi">Id Prodi</label>
													<input type="text" name="id_prodi" class="form-control" placeholder="Masukan id prodi" id="id_prodi" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="kelas">Kelas</label>
													<input type="text" name="kelas" class="form-control" placeholder="Masukan Kelas" id="kelas" required>
												</div>
												<div class="form-group">
													<label class="control-label" for="Nilai">Nilai</label>
													<input type="text" name="Nilai" class="form-control" placeholder="Masukan Nilai" id="Nilai" required>
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
									var id_pkl = $(this).data('id');
									var Nim_pkl = $(this).data('Nim');
									var Nip_pkl = $(this).data('Nip');
									var pr_pkl = $(this).data('id_prodi');
									var kelas_pkl = $(this).data('kelas');
									var Nilai_pkl = $(this).data('Nilai');
									$("#modal-edit #id_perkuliahan").val(id_pkl);
									$("#modal-edit #Nim").val(Nim_pkl);
									$("#modal-edit #Nip").val(Nip_pkl);
									$("#modal-edit #id_prodi").val(pr_pkl);
									$("#modal-edit #kelas").val(kelas_pkl);
									$("#modal-edit #Nilai").val(Nilai_pkl);
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
		$pkl->hapus($_GET['id']);
		// redirect
		header("location: ?page=perkuliahan");
	}
