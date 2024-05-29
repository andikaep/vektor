<?php
$banner = $this->global_mod->view('admin_banner')->result_array();
?>

<!-- banner -->
<div id="slider" class="carousel slide" data-ride="carousel">
	<!-- Indicators-->
	<div class="carousel-inner">
		<?php foreach ($banner as $b) : ?>
			<div class="carousel-item item1 <?= $b['urutan_banner'] == 1 ? 'active' : '' ?>" style="background-image:url(<?= base_url('uploads/banner/') . $b['gambar_banner'] ?>);">
				<div class="container">
					<div class="w3l-space-banner">
						<div class="carousel-caption p-lg-5 p-sm-4 p-3">
							<p><?= $b['keterangan_banner'] ?></p>
							<h3 class="font-weight-bold pt-2 pb-lg-5 pb-4">
								<?= $b['judul_banner'] ?>
							</h3>
							<a class="button2" href="<?= base_url() . $b['link_banner'] ?>">Lihat Produk</a>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#slider" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
<!-- //banner -->