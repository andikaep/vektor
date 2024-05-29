<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('front/templates/header');
$this->load->view('front/templates/topheader');
$this->load->view('front/templates/navigation');
if (!$judul) {
	$this->load->view('front/templates/banner');
}
?>

<!-- top Products -->
<div class="ads-grid py-sm-5 py-4" background-color="green";>
	<div class="container py-xl-4 py-lg-2">
		<!-- tittle heading -->
		<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
			<?= $judul ? $judul : '<span>Semua Produk</span>' ?>
		</h3>
		<!-- //tittle heading -->
		<div class="row">
			<!-- product left -->
			<div class="agileinfo-ads-display col-lg-9">
				<div class="wrapper">
					<!-- first section -->
					<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
						<div class="row">
							<?php
							if (count($produk) == 0) :
								echo "<h4 class='tittle-w3l mx-auto'>
								<span>Produk Tidak Ada</span>
							</h4>";
							else :
								foreach ($produk as $p) :
									?>
									<div class="col-md-4 product-men mt-5">
										<div class="men-pro-item simpleCart_shelfItem">
											<div class="men-thumb-item text-center">
												<img src="<?= base_url('uploads/produk/') . $p['gambar'] ?>" width="200" height="200" class="rounded mx-auto d-block">
												<div class="men-cart-pro">
													<div class="inner-men-cart-pro">
														<a href="<?= base_url('produk/detail/') . $p['seo_produk'] ?>" class="link-product-add-cart">Selengkapnya</a>
													</div>
												</div>
											</div>
											<div class="item-info-product text-center border-top mt-4">
												<h4 class="pt-1">
													<a href="<?= base_url('produk/detail/') . $p['seo_produk'] ?>"><?= $p['nama_produk'] ?></a>
												</h4>
												<div class="info-product-price my-2">
													<span class="item_price">Rp. <?= rupiah($p['harga_jual'] - $p['diskon']) ?></span>
													<del><?= $p['diskon'] ? $p['harga_jual'] : "" ?></del>
												</div>
												
											</div>
										</div>
									</div>
								<?php
								endforeach;
							endif;
							?>

						</div>
					</div>
					<div class="row">
						<div class="col">
							<?= $this->pagination->create_links(); ?>
						</div>
					</div>
				</div>
			</div>
			<!-- //product left -->

			<?php $this->load->view('front/templates/sidebar'); ?>
		</div>
	</div>
</div>
<!-- //top products -->

<?php $this->load->view('front/templates/footer'); ?>