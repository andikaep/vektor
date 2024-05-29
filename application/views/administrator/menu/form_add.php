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
                        <form class="needs-validation" novalidate="" method="POST" action="<?= base_url() ?>admin/menu/add">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Menu</label>
                                    <input type="text" name="nama_menu" class="form-control" required="" placeholder="Masukkan nama menu">
                                    <div class="invalid-feedback">
                                        Nama menu tidak valid
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="menuutama">Menu Utama</label>
                                    <select class="form-control" name="id_parent" id="menuutama">
                                        <option value="0">Menu Utama</option>
                                        <?php foreach ($menuutama as $key) : ?>
                                            <option value="<?= $key['id'] ?> "><?= $key['nama_menu'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Link</label>
                                    <input type="text" name="link_menu" class="form-control" required="" placeholder="Masukkan link">
                                    <div class="invalid-feedback">
                                        Link tidak valid.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Icon</label>
                                    <input type="text" name="icon_menu" class="form-control" required="" placeholder="Masukkan icon">
                                    <div class="invalid-feedback">
                                        Icon tidak valid
                                    </div>
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