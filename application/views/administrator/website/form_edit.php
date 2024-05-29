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
                        <form class="needs-validation" novalidate="" method="POST" action="<?= base_url() ?>admin/web/website/edit/<?= $website['id']; ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Website</label>
                                    <input type="text" name="nama_website" class="form-control" required="" placeholder="Masukkan nama website" value="<?= $website['nama_website'] ?>">
                                    <div class="invalid-feedback">
                                        Nama website tidak valid
                                    </div>
                                    <?= form_error('nama_website', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Nama Singkatan</label>
                                    <input type="text" name="nama_website_singkat" class="form-control" required="" placeholder="Masukkan Nama Singkatan (Max 3 Huruf)" value="<?= $website['nama_website_singkat'] ?>">
                                    <div class="invalid-feedback">
                                        Nama Singkatan tidak valid.
                                    </div>
                                    <?= form_error('nama_website_singkat', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Logo Website</label>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img id="image-preview" src="<?= base_url('uploads/') . $website['logo_website']; ?>" width="140px" height="140px" class="img-thumbnail">
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" name="image" onchange="previewImage();">
                                                <label class="custom-file-label" for="image">Pilih Gambar</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Footer</label>
                                    <input type="text" name="footer_website" class="form-control" required="" placeholder="Masukkan Footer" value="<?= $website['footer_website'] ?>">
                                    <div class="invalid-feedback">
                                        Footer tidak valid
                                    </div>
                                    <?= form_error('footer_website', '<small class="text-danger pl-3">', '</small>'); ?>
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
<script>
    function previewImage() {
        document.getElementById("image-preview").style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("image").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("image-preview").src = oFREvent.target.result;
        };
    };
</script>

<?php $this->load->view('templates/footer'); ?>