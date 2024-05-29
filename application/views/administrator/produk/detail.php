<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/header');
$this->load->view('templates/layout');
$this->load->view('templates/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Produk</a></div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title"><?= $produk['nama_produk']; ?></h2>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img alt="image" src="<?php echo base_url('uploads/produk/') . $produk['gambar']; ?>" class="rounded-circle profile-widget-picture img-thumbnail ">
                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Harga Beli</div>
                                    <div class="profile-widget-item-value">Rp. <?= $produk['harga_beli']; ?></div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Harga Jual</div>
                                    <div class="profile-widget-item-value">Rp. <?= $produk['harga_jual']; ?></div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Stok</div>
                                    <div class="profile-widget-item-value"><?= $produk['stok'] ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name"><?= $produk['nama_produk']; ?> <div class="text-muted d-inline font-weight-normal">
                                    <div class="slash"></div>Diskon Harga, Rp. <?= $produk['diskon']; ?>
                                </div>
                            </div>
                            <?= $produk['keterangan']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    function confirmDel() {
        return confirm("Anda Yakin?");
    }
</script>
<?php $this->load->view('templates/footer'); ?>