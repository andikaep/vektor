<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('front/templates/header');
$this->load->view('front/templates/topheader');
$this->load->view('front/templates/navigation');
?>

<!-- page -->
<div class="services-breadcrumb">
    <div class="agile_inner_breadcrumb">
        <div class="container">
            <ul class="w3_short">
                <li>
                    <a href="<?= base_url(); ?>">Beranda</a>
                    <i>|</i>
                </li>
                <li>Detail</li>
            </ul>
        </div>
    </div>
</div>
<!-- endpage -->

<!-- Single Page -->
<div class="banner-bootom-w3-agileits py-5">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
            <?= $produk['nama_produk'] ?>
        </h3>
        <!-- //tittle heading -->
        <div class="row">
            <div class="col-lg-5 col-md-8 single-right-left ">
                <div class="grid images_3_of_2">
                    <div class="flexslider">
                        <ul class="slides">
                            <li data-thumb="<?= base_url('uploads/produk/') . $produk['gambar']  ?>">
                                <div class="thumb-image">
                                    <img src="<?= base_url('uploads/produk/') . $produk['gambar']  ?>" data-imagezoom="true" class="img-fluid"> </div>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 single-right-left simpleCart_shelfItem">
                <h3 class="mb-3"><?= $produk['nama_produk'] ?></h3>
                <p class="mb-3">
                    <span class="item_price">Rp. <?= rupiah($produk['harga_jual'] - $produk['diskon']) ?></span>
                    <del><?= $produk['diskon'] ? $produk['harga_jual'] : "" ?></del>
                </p>
            
                    <?= $produk['keterangan'] ?>
                   
                                <div class="input-group-append">
                                    <button class="btn btn-success" onclick="window.location.href='https://bit.ly/vektorkreatif';">Ke Whatsapp</button>
                                </div>
                            
            </div>
        </div>
    </div>
</div>
<!-- //Single Page -->

<?php
$this->load->view('front/templates/footer');
?>