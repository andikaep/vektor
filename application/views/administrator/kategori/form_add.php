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
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <form class="needs-validation" novalidate="" method="POST" action="<?= base_url() ?>admin/modul/kategori/add">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Kategori</label>
                                    <input type="text" name="nama_kategori" class="form-control" required="" placeholder="Masukkan nama kategori">
                                    <div class="invalid-feedback">
                                        Nama kategori tidak valid
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kategoriutama">Kategori Utama</label>
                                    <select class="form-control" name="id_parent" id="kategoriutama">
                                        <option value="0">Kategori Utama</option>
                                        <?php foreach ($kategoriutama as $key) : ?>
                                            <option value="<?= $key['id'] ?> "><?= $key['nama_kategori'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak aktif</option>
                                    </select>
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