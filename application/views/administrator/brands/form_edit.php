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
                <div class="breadcrumb-item active"><a href="#">Menu</a></div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title"><?= $title ?></h2>
            <div class="row">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card">
                        <form class="needs-validation" novalidate="" method="POST" action="<?= base_url() ?>admin/web/marketplace/edit/<?= $brands['id']; ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Marketplace</label>
                                    <input type="text" name="nama_brands" class="form-control" required="" placeholder="Masukkan Penyedia" value="<?= $brands['nama_brands'] ?>" disabled>
                                    <div class="invalid-feedback">
                                        Penyedia tidak valid
                                    </div>
                                    <?= form_error('nama_brands', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Link</label>
                                    <input type="text" name="link" class="form-control" required="" placeholder="Masukkan Link" value="<?= $brands['link'] ?>">
                                    <div class="invalid-feedback">
                                        API Key tidak valid.
                                    </div>
                                    <?= form_error('link', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('templates/footer'); ?>