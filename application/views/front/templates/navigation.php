<?php
$website = $this->global_mod->view('admin_website')->row_array();
$kategori = $this->global_mod->view('admin_kategori')->result_array();
$uri = $this->uri->segment(1);
?>
<!-- header-bottom-->
<div class="headbot">
	<div class="container">
		<div class="row header-bot_inner_wthreeinfo_header_mid">
			<!-- logo -->
			<div class="col-md-3 logo_agile">
				<h1 class="text-center">
					<a href="<?= base_url(); ?>" class="font-weight-bold font-italic">
						<img src="<?= base_url('uploads/') . $website['logo_website'] ?>" style="max-height:80px;" class="img-fluid">
						<span class="m-3"><?= $website['nama_website'] ?></span>
					</a>
				</h1>
			</div>
			<!-- //logo -->
			<!-- header-bot -->
			<div class="col-md-9 header mt-4 mb-md-0 mb-4">
				<div class="row">
					<!-- search -->
					<div class="col-12 agileits_search">
						<form class="form-inline" action="<?= base_url('produk') ?>" method="post">
							<input class="form-control mr-sm-2" name="cari" type="search" placeholder="Ketik dan Enter" aria-label="Search" required>
							<button class="btn my-2 my-sm-0" type="submit">Cari</button>
						</form>
					</div>
					<!-- //search -->
				</div>
			</div>
		</div>
	</div>
</div>
<!-- shop locator (popup) -->
<!-- //header-bottom -->
<!-- navigation -->
<!-- <div class="navbar-inner">
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="agileits-navi_search">
				<form action="<?= base_url() ?>" method="post" id="kategori">
					<select id="agileinfo-nav_search" name="agileinfo_search" class="border" required="">
						<option value="">Semua Kategori</option>
						<?php foreach ($kategori as $k) : ?>
																	<?php if ($k['id_parent'] == 0) : ?>
																												<option value="<?= $k['seo_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
																	<?php endif; ?>
						<?php endforeach; ?>
					</select>
				</form>
			</div>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto text-center mr-xl-5">
					<li class="nav-item <?= $uri == 'home' ? 'active' : '' ?> mr-lg-2 mb-lg-0 mb-2">
						<a class="nav-link" href="<?= base_url(); ?>">HOME
							<span class="sr-only">(current)</span>
						</a>
					</li>
					<?php foreach ($kategori as $k) :
						if ($k['seo_kategori'] == $uri) {
							$active = 'active';
						} else {
							$active = '';
						}
						$subkategori = $this->global_mod->view_where('admin_kategori', ['id_parent' => $k['id']]);
						if ($k['is_active'] == 1) :
							if ($k['id_parent'] == 0) : ?>
																																						<li class="nav-item mr-lg-2 mb-lg-0 mb-2">
																																							<a class="nav-link <?= $active ?>" href="<?= base_url('produk/kategori/') . $k['seo_kategori']; ?>"><?= strtoupper($k['nama_kategori']) ?>
																																								<span class="sr-only">(current)</span>
																																							</a>
																																						</li>
																											<?php endif; ?>
																											</li>
																<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
		</nav>
	</div>
</div> -->
<!-- //navigation -->