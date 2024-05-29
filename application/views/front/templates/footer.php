<?php
$website = $this->global_mod->view('admin_website')->row_array();
$toko = $this->global_mod->view('admin_toko')->row_array();
$kategori = $this->global_mod->view('admin_kategori')->result_array();
?>

<!-- footer -->
<footer>
	<div class="w3l-middlefooter-sec footer-top-first">
		<div class="container py-md-5 py-sm-4 py-3">
			<!-- footer first section -->
			<h2 class="text-white footer-top-head-w3l font-weight-bold mb-2"><?= $website['nama_website']; ?> </h2>
			<p class="text-white footer-main mb-4">
				<?= $toko['deskripsi']; ?>
			</p>
			<!-- //footer first section -->
			<!-- footer second section -->
			<div class="row w3l-grids-footer border-top border-bottom py-sm-4 py-3">
				<div class="col-md-4 offer-footer">
					<div class="row">
						<div class="col-4 icon-fot">
							<i class="fas fa-camera-retro"></i>
						</div>
						<div class="col-8 text-form-footer">
							<h3 class="text-white">Vektor</h3>
							<p class="text-white">Ubah Foto Menjadi Lebih Menarik</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 offer-footer my-md-0 my-4">
					<div class="row">
						<div class="col-4 icon-fot">
							<i class="fas fa-calendar-check"></i>
						</div>
						<div class="col-8 text-form-footer">
							<h3 class="text-white">Respon Cepat</h3>
							<p class="text-white">24/7 Passionate Support</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 offer-footer">
					<div class="row">
						<div class="col-4 icon-fot">
							<i class="fas fa-gift"></i>
						</div>
						<div class="col-8 text-form-footer">
							<h3 class="text-white">Pilih Style</h3>
							<p class="text-white">Tersedia 4 Style</p>
						</div>
					</div>
				</div>
			</div>
			<!-- //footer second section -->
		</div>
	</div>
	<!-- footer third section -->
	<div class="footer-top-first">
		<div class="container py-md-5 py-sm-4 py-3">
			<div class="row footer-info">
				<!-- footer categories -->
				<div class="col-md-3 col-sm-6 footer-grids">
					<h3 class="font-weight-bold mb-3">Kategori</h3>
					<ul>
						<?php foreach ($kategori as $k) : ?>
							<?php if ($k['id_parent'] == 0) : ?>
								<li class="mb-3">
									<a href="<?= base_url('produk/kategori/') . $k['seo_kategori']; ?>"><b> <?= $k['nama_kategori'] ?> </b> </a>
								</li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				</div>
				<!-- //footer categories -->
				<!-- quick links -->
				<div class="col-md-3 col-sm-6 footer-grids mt-md-0 mt-4">
					<h3 class="font-weight-bold mb-3">Hubungi Kami</h3>
					<ul>
						<li class="mb-3">
							<i class="fas fa-map-marker"></i> <?= $toko['alamat_toko'] ?></li>
						<li class="mb-3">
							<i class="fas fa-phone"></i> <?= $toko['no_telp_toko'] ?> </li>
						<li class="mb-3">
							<i class="fab fa-whatsapp"></i> <?= $toko['wa'] ?> </li>
						<li class="mb-3">
							<i class="fas fa-envelope-open"></i>
							<a href="mailto:<?= $toko['email_toko'] ?>"> <?= $toko['email_toko'] ?></a>
						</li>
					</ul>
				</div>

				<div class="col-md-3 col-sm-6 footer-grids w3l-agileits mt-md-0 mt-4">
					<h3 class="font-weight-bold mb-3">&nbsp;&nbsp;&nbsp;Melayani</h3>
					<img src="<?= base_url('uploads/brands/jo.png') ?>" width="300px">
					</div>
					<!-- social icons -->
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="footer-grids  w3l-socialmk mt-3">
						<h3 class="font-weight-bold mb-3">Sosial Media</h3>
						<div class="social">
							<ul>
								
								<li>
									<a class="icon tw" href="<?= $toko['twitter'] ?>">
										<i class="fab fa-twitter"></i>
									</a>
								</li>
								<li>
									<a class="icon gp" href="<?= $toko['instagram'] ?>">
										<i class="fab fa-instagram"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<!-- //social icons -->
				
			</div>
			<!-- //quick links -->
		</div>
	</div>
	<!-- //footer third section -->
</footer>
<!-- //footer -->
<!-- copyright -->
<div class="copy-right py-3">
	<div class="container">
		<p class="text-center text-white">© <?= $website['footer_website'] ?>. All rights reserved</a>
		</p>
	</div>
</div>
<!-- //copyright -->

<!-- js-files -->
<!-- jquery -->
<script src="<?= base_url('assets/front/') ?>js/jquery.min.js"></script>
<script src="<?= base_url('assets/front/') ?>js/terbilang.min.js"></script>
<!-- //jquery -->

<!-- nav smooth scroll -->
<script>
	$(document).ready(function() {
		$(".dropdown").hover(
			function() {
				$('.dropdown-menu', this).stop(true, true).slideDown("fast");
				$(this).toggleClass('open');
			},
			function() {
				$('.dropdown-menu', this).stop(true, true).slideUp("fast");
				$(this).toggleClass('open');
			}
		);
	});
</script>
<!-- //nav smooth scroll -->

<!-- popup modal (for location)-->
<script src="<?= base_url('assets/front/') ?>js/jquery.magnific-popup.js"></script>
<script>
	$(document).ready(function() {
		$('.popup-with-zoom-anim').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});

	});
</script>
<!-- //popup modal (for location)-->

<!-- cart-js -->
<script src="<?= base_url('assets/front/') ?>js/minicart.js"></script>
<script>
	paypals.minicarts.render(); //use only unique class names other than paypals.minicarts.Also Replace same class name in css and minicart.min.js

	// var total;
	paypals.minicarts.cart.on('checkout', function(evt) {
		var items = this.items(),
			len = items.length,
			total = 0,
			i;

		// Count the number of each item in the cart
		for (i = 0; i < len; i++) {
			total += items[i].get('quantity');
		}
	});
	// console.log(total);
	// var t = paypals.minicarts.cart.items().length;
</script>
<!-- //cart-js -->

<?php if ($this->uri->segment(1) == 'konsumen' || $this->uri->segment(1) == 'checkout') : ?>
	<script>
		paypals.minicarts.reset();
	</script>
<?php endif; ?>

<!-- password-script -->
<script>
	window.onload = function() {
		document.getElementById("password").onchange = validatePassword;
		document.getElementById("password_konfirmasi").onchange = validatePassword;
	}

	function validatePassword() {
		var pass2 = document.getElementById("password_konfirmasi").value;
		var pass1 = document.getElementById("password").value;
		if (pass1 != pass2)
			document.getElementById("password_konfirmasi").setCustomValidity("Passwords Don't Match");
		else
			document.getElementById("password_konfirmasi").setCustomValidity('');
		//empty string means no validation error
	}
</script>
<!-- //password-script -->

<!-- imagezoom -->
<!-- <script src="<?= base_url('assets/front/') ?>js/imagezoom.js"></script> -->
<!-- //imagezoom -->

<!-- flexslider -->
<link rel="stylesheet" href="<?= base_url('assets/front/') ?>css/flexslider.css" type="text/css" media="screen" />

<script src="<?= base_url('assets/front/') ?>js/jquery.flexslider.js"></script>
<script>
	// Can also be used with $(document).ready()
	// $(window).load(function() {
	jQuery(document).ready(function($) {
		$('.flexslider').flexslider({
			animation: "slide",
			controlNav: "thumbnails"
		});
	});
</script>
<!-- //FlexSlider-->

<!-- scroll seller -->
<script src="<?= base_url('assets/front/') ?>js/scroll.js"></script>
<!-- //scroll seller -->

<!-- bootbox seller -->
<script src="<?= base_url('assets/front/') ?>js/bootbox.all.min.js"></script>
<!-- //bootbox seller -->

<!-- smoothscroll -->
<script src="<?= base_url('assets/front/') ?>js/SmoothScroll.min.js"></script>
<!-- //smoothscroll -->

<!-- start-smooth-scrolling -->
<script src="<?= base_url('assets/front/') ?>js/move-top.js"></script>
<script src="<?= base_url('assets/front/') ?>js/easing.js"></script>
<script>
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event) {
			event.preventDefault();

			$('html,body').animate({
				scrollTop: $(this.hash).offset().top
			}, 1000);
		});
	});
</script>
<!-- //end-smooth-scrolling -->

<!-- smooth-scrolling-of-move-up -->
<script>
	$(document).ready(function() {
		/*
		var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
		};
		*/
		$().UItoTop({
			easingType: 'easeOutQuart'
		});

	});
</script>
<!-- //smooth-scrolling-of-move-up -->

<script>
	$(document).ready(function() {
		// Login Form
		$("#loginForm").submit(function(event) {
			event.preventDefault();
			var url = $("#loginForm").attr("action");
			$.ajax({
				url: url,
				type: 'post',
				data: $("#loginForm").serialize(),
				dataType: 'json',
				success: function(data) {
					// console.log(data);
					if (data.login == false) {
						$("#statuslog").html(data.status);
						$("#passlog").val("");
					} else {
						// console.log(data.login);
						window.location = "<?= base_url(); ?>";
					}
				}
			});
		});

		// Registrasi Form
		$("#registrasiForm").submit(function(event) {
			event.preventDefault();
			var url = $("#registrasiForm").attr("action");
			$.ajax({
				url: url,
				type: 'post',
				data: $("#registrasiForm").serialize(),
				dataType: 'json',
				success: function(data) {
					// console.log(data);
					$("#statusreg").html(data.status);
					$("#usernamereg").val("");
					$("#no_telpreg").val("");
					$("#password").val("");
					$("#password_konfirmasi").val("");
					$("#alamat_pengiriman").val("");
					$("#kota").val("0");
					setTimeout(function() {
						window.location = "<?= base_url(); ?>"
					}, 2000);
				}
			});
		});
	});
</script>

<script type="text/javascript">
	$(function() {
		$.ajaxSetup({
			type: "POST",
			url: "<?php echo base_url('kurir/ambil_data') ?>",
			cache: false,
		});

		//Pilih kurir 
		$("#kurir").change(function() {
			var kurir = $(this).val();
			var kota = $("#kota_alamat").val();
			if (kurir != '') {
				$.ajax({
					data: {
						kurir: kurir,
						kota: kota,
					},
					success: function(respond) {
						$("#layanan").html(respond);
					}
				})
			}
		});

		function formatRupiah(angka, prefix) {
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
				split = number_string.split(','),
				sisa = split[0].length % 3,
				rupiah = split[0].substr(0, sisa),
				ribuan = split[0].substr(sisa).match(/\d{3}/gi);

			if (ribuan) {
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}

		// pilih layanan
		$("#layanan").change(function() {
			var subtotal = <?= $tot ? $tot : '0' ?>;
			var layanan = $(this).val();
			if (layanan != '') {
				var ongkir = formatRupiah(layanan, 'Rp.');
				var total = parseInt(layanan) + parseInt(subtotal);
				var totalubah = formatRupiah(total.toString(), 'Rp. ');
				var terbil = terbilang(total);
				$('#ongkir_dinamis').text(ongkir);
				$('#total_dinamis').text(totalubah);
				$('#terbil_dinamis').text(terbil);
			}
		});

		// <!-- Ajax add to cart -->
		$(".mycart").submit(function(event) {
			event.preventDefault();
			var url = $(".mycart").attr('action');
			var idproduk = $(this).data('idproduk');
			var qty = $('#' + idproduk).val();
			if (qty != '' && qty > 0) {
				$.ajax({
					url: url,
					method: 'POST',
					data: {
						qty: qty,
						id_produk: idproduk
					},
					dataType: 'json',
					success: function(data) {
						if (data.cart == true) {
							// console.log(data[1].count);
							$('#len_checkout').text(data[1].count);
							bootbox.alert("Berhasil ditambahkan!");
						} else {
							bootbox.alert("Gagal, Harap Login terlebih dahulu!");
						}
					}
				});
			} else {
				alert("Harap masukkan quantity!")
			}
		});
		// Ajax update to cart
		$(".upcart").submit(function(event) {
			event.preventDefault();
			var url = $(".upcart").attr('action');
			var idpro = $(this).data('idpro');
			var qty = $('#' + idpro).val();
			if (qty != '' && qty > 0) {
				$.ajax({
					url: url,
					type: 'post',
					data: {
						id_produk: idpro,
						qty: qty
					},
					dataType: 'json',
					success: function(data) {
						if (data.cart == true) {
							// console.log(data);
							var sub = formatRupiah(data[0].subtotal.toString(), 'Rp. ');
							var tot = formatRupiah(data[0].total.toString(), 'Rp. ');
							var ter = terbilang(data[0].total);
							$(".subtext" + idpro).text(sub);
							$(".total").text(tot);
							$(".terbilang").text(ter + " Rupiah");
						}
					}
				});
			}
		});


	});
</script>

<!-- for bootstrap working -->
<script src="<?= base_url('assets/front/') ?>js/bootstrap.js"></script>
<!-- //for bootstrap working -->
<!-- //js-files -->
</body>

</html>