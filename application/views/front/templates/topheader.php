<?php
$website = $this->global_mod->view('admin_website')->row_array();
$toko = $this->global_mod->view('admin_toko')->row_array();
$kota = $this->global_mod->view('kota')->result_array();
?>

<body>
	<!-- top-header -->
	<div class="agile-main-top fixed-top">
		<div class="container-fluid">
			<div class="row main-top-w3l py-3">
				<div class="col-lg-6 header-most-top">
					<a href="<?= base_url() ?>">
						<p class="text-white text-lg-left text-center">
							<i class="fas fa-shopping-cart ml-1"></i>
							<b><?= $website['nama_website'] ?> </b>
							<i>"<?= $toko['motto_toko']; ?>"</i>
						</p>
					</a>
				</div>
				<!-- cart details -->
				<!-- //cart details -->
			</div>
		</div>
	</div>

	<!-- modals -->
	<!-- log in -->
	<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-center">Log In</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="statuslog"></div>
					<form id="loginForm" action="<?= base_url('konsumen/ceklogin'); ?>" method="post">
						<div class="form-group">
							<label class="col-form-label">Username</label>
							<input type="text" id="userlog" name="username" class="form-control" placeholder=" " required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Password</label>
							<input type="password" id="passlog" name="password" class="form-control" placeholder=" " required="">
						</div>
						<div class="right-w3l">
							<button type="submit" id="btn-submit" class="btn btn-primary form-control">Submit</button>
						</div>
						<div class="sub-w3l">
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="customControlAutosizing">
								<label class="custom-control-label" for="customControlAutosizing">Remember me?</label>
							</div>
						</div>
						<p class="text-center dont-do mt-3">Don't have an account?
							<a href="#" data-toggle="modal" data-target="#registrasi">
								Register Now</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- register -->
	<div class="modal fade" id="registrasi" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Register</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="statusreg"></div>
					<form id="registrasiForm" action="<?= base_url('konsumen/registrasi') ?>" method="post">
						<div class="form-group">
							<label class="col-form-label">Username</label>
							<input type="text" class="form-control" placeholder="Username" id="usernamereg" name="username" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">No Hp</label>
							<input type="number" class="form-control" placeholder="No Handphone atau WA" name="no_telp" id="no_telpreg" required="">
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-form-label">Password</label>
									<input type="password" class="form-control" placeholder="Password" name="password" id="password" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-form-label">Confirm Password</label>
									<input type="password" class="form-control" placeholder="Konfirmasi Password" name="konfirmasi_password" id="password_konfirmasi" required="">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-form-label">Alamat pengiriman</label>
									<input type="text" class="form-control" placeholder="Alamat pengiriman" name="alamat_pengiriman" id="alamat_pengiriman" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-form-label">Kota pengiriman</label>
									<select class="form-control" id="kota" name="kota">
										<option value="0"> -- PILIH KOTA --</option>
										<?php foreach ($kota as $k) : ?>
											<option value="<?= $k['id']; ?>"><?= $k['nama_kota']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
						<div class="sub-w3l">
							<div class="custom-control custom-checkbox mr-sm-2">
								<input type="checkbox" class="custom-control-input" id="customControlAutosizing2">
								<label class="custom-control-label" for="customControlAutosizing2">I Accept to the Terms & Conditions</label>
							</div>
						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control" value="Register">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- //modal -->
	<!-- //top-header -->