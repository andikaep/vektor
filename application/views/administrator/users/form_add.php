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
                <div class="breadcrumb-item active"><a href="#">Users</a></div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title"><?= $title ?></h2>
            <div class="row">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card">
                        <form class="needs-validation" novalidate="" method="POST" action="<?= base_url() ?>admin/users/add" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" required="" placeholder="Masukkan username" value="<?= set_value('username') ?>">
                                    <div class="invalid-feedback">
                                        Username tidak valid
                                    </div>
                                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="Password" name="password" class="form-control" placeholder="Masukkan password">
                                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Konfirmasi Password</label>
                                    <input type="Password" name="password_konfirmasi" class="form-control" placeholder="Masukkan Konfirmasi password">
                                    <?= form_error('password_konfirmasi', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Nama lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control" required="" placeholder="Masukkan nama lengkap" value="<?= set_value('nama_lengkap') ?>">
                                    <div class="invalid-feedback">
                                        Nama lengkap tidak valid.
                                    </div>
                                    <?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required="" placeholder="Masukkan email" value="<?= set_value('email') ?>">
                                    <div class="invalid-feedback">
                                        Email tidak valid
                                    </div>
                                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Nomor Telephon</label>
                                    <input type="text" name="no_telp" class="form-control" required="" placeholder="Masukkan Nomor Telphone" value="<?= set_value('no_telp') ?>">
                                    <div class="invalid-feedback">
                                        Nomor Telphone tidak valid
                                    </div>
                                    <?= form_error('no_telp', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <label>Foto</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <img id="image-preview" width="120px" height="120px" class="rounded-circle">
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
                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <select class="form-control" id="level" name="level">
                                        <option value="admin">Admin</option>
                                        <option value="user">User</option>
                                    </select>
                                    <?= form_error('level', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                    <?= form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
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