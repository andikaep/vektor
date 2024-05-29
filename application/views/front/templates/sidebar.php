<?php
$kategori = $this->global_mod->view('admin_kategori')->result_array();
$best = $this->global_mod->best_seller();
$brands = $this->global_mod->view_where('admin_brands', ['status' => 1])->result_array();
$uri = $this->uri->segment(1);
?>
<!-- product right -->
<div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
	<div class="side-bar p-sm-4 p-3">
		<div class="search-hotel border-bottom py-2">
			<h3 class="agileits-sear-head mb-3">Cari</h3>
			<form action="<?= base_url('produk')  ?>" method="post">
				<input type="search" placeholder="Ketik dan Enter" name="cari" required="">
				<input type="submit" value=" ">
			</form>
		</div>
		<!-- best seller -->
		<div class="f-grid border-bottom mt-2 py-2">
			<h3 class="agileits-sear-head mb-3">Best Seller</h3>
			<?php foreach ($best as $b) : ?>
				<div class="row">
					<div class="col-lg-3 col-sm-2 col-3 left-mar mt-2">
						<img src="<?= base_url('uploads/produk/') . $b['gambar'] ?>" width="60px">
					</div>
					<div class="col-lg-9 col-sm-10 col-9 w3_mvd">
						<a href="<?= base_url('produk/detail/') . $b['seo_produk'] ?>"><?= $b['nama_produk'] ?></a>
						<a href="<?= base_url('produk/detail/') . $b['seo_produk'] ?>" class="price-mar mt-2">Rp. <?= rupiah($b['harga_jual']) ?></a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<!-- //best seller -->
		<!-- electronics -->
				<!-- <div class="left-side mt-2 py-2">
			<h3 class="agileits-sear-head mb-3">Kategori</h3>
			<ul>
				<li>
					<?php foreach ($kategori as $k) :
						$subkategori = $this->global_mod->view_where('admin_kategori', ['id_parent' => $k['id']]);
						if ($k['is_active'] == 1) : ?>
							<ul class="ml-2">
								<?php if ($k['id_parent'] == 0) : ?>
									<li><a href="<?= base_url('produk/kategori/') . $k['seo_kategori']; ?>"><?= $k['nama_kategori'] ?></a></li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>
					<?php endforeach; ?>
				</li>
			</ul>
		</div> -->
		<!-- //electronics -->
		<!-- shopee tokopedia -->
		<div class="left-side mt-2 py-2">
			<h3 class="agileits-sear-head mb-3"><b>Buat CV Mudah & Murah</b></h3>
			<ul>
				<?php foreach ($brands as $b) : ?>
					<li>
						<a href="<?= $b['link'] ?>">
							<img src="<?= base_url('uploads/brands/') . $b['gambar'] ?>" width="200px">
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<!-- //shopee tokopedia -->
	</div>
	<!-- //product right -->
</div>