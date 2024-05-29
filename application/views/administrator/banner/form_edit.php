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
                <div class="breadcrumb-item active"><a href="#">Banner</a></div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title"><?= $title ?></h2>
            <div class="row">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card">
                        <form class="needs-validation" novalidate="" method="POST" action="<?= base_url() ?>admin/web/banner/add/<?= $banner['id']; ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Judul Banner</label>
                                    <input type="text" name="judul_banner" class="form-control" required="" placeholder="Masukkan nama website" value="<?= $banner['judul_banner'] ?>">
                                    <div class="invalid-feedback">
                                        Judul banner tidak valid
                                    </div>
                                    <?= form_error('judul_banner', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" name="keterangan_banner" class="form-control" required="" placeholder="Masukkan keterangan" value="<?= $banner['keterangan_banner'] ?>">
                                    <div class="invalid-feedback">
                                        Keterangan tidak valid.
                                    </div>
                                    <?= form_error('keterangan_banner', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Link</label>
                                    <input type="text" name="link_banner" class="form-control" required="" placeholder="Masukkan Link" value="<?= $banner['link_banner'] ?>">
                                    <div class="invalid-feedback">
                                        Link tidak valid
                                    </div>
                                    <?= form_error('link_banner', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Gambar Banner</label>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img id="image-preview" src="<?= base_url('uploads/banner/') . $banner['gambar_banner']; ?>" width="140px" height="140px" class="img-thumbnail">
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" name="image" onchange="previewImage();">
                                                <label class="custom-file-label" for="image">Pilih Gambar</label>
                                            </div>
                                        </div>
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