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
                        <form class="needs-validation" novalidate="" method="POST" action="<?= base_url() ?>admin/web/toko/edit/<?= $toko['id']; ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Pemilik Toko</label>
                                    <input type="text" name="pemilik_toko" class="form-control" required="" placeholder="Masukkan Pemilik Toko" value="<?= $toko['pemilik_toko'] ?>">
                                    <div class="invalid-feedback">
                                        Pemilik Toko tidak valid
                                    </div>
                                    <?= form_error('pemilik_toko', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Brand Toko</label>
                                    <input type="text" name="motto_toko" class="form-control" required="" placeholder="Masukkan Brand" value="<?= $toko['motto_toko'] ?>">
                                    <div class="invalid-feedback">
                                        Brand tidak valid.
                                    </div>
                                    <?= form_error('motto_toko', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Telphone</label>
                                    <input type="text" name="no_telp_toko" class="form-control" required="" placeholder="Masukkan Telphone" value="<?= $toko['no_telp_toko'] ?>">
                                    <div class="invalid-feedback">
                                        Telphone tidak valid
                                    </div>
                                    <?= form_error('no_telp_toko', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email_toko" class="form-control" required="" placeholder="Masukkan Email" value="<?= $toko['email_toko'] ?>">
                                    <div class="invalid-feedback">
                                        Email tidak valid
                                    </div>
                                    <?= form_error('email_toko', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" name="alamat_toko" class="form-control" required="" placeholder="Masukkan alamat" value="<?= $toko['alamat_toko'] ?>">
                                    <div class="invalid-feedback">
                                        Alamat tidak valid
                                    </div>
                                    <?= form_error('alamat_toko', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="kota">Kota</label>
                                    <select class="form-control" name="kota" id="kota" required>
                                        <?php foreach ($kota as $key) : ?>
                                            <?php if ($key['id'] == $toko['id_kota_toko']) : ?>
                                                <option selected value="<?= $key['id'] ?> "><?= $key['nama_kota'] ?></option>
                                            <?php else : ?>
                                                <option value="<?= $key['id'] ?> "><?= $key['nama_kota'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        kota tidak valid
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Whatsapp</label>
                                    <input type="text" name="wa" class="form-control" required="" placeholder="Masukkan Whatsapp" value="<?= $toko['wa'] ?>">
                                    <div class="invalid-feedback">
                                        Whatsapp tidak valid
                                    </div>
                                    <?= form_error('wa', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" name="facebook" class="form-control" required="" placeholder="Masukkan Facebook" value="<?= $toko['facebook'] ?>">
                                    <div class="invalid-feedback">
                                        Facebook tidak valid
                                    </div>
                                    <?= form_error('facebook', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="text" name="instagram" class="form-control" required="" placeholder="Masukkan instagram" value="<?= $toko['instagram'] ?>">
                                    <div class="invalid-feedback">
                                        instagram tidak valid
                                    </div>
                                    <?= form_error('instagram', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Twitter</label>
                                    <input type="text" name="twitter" class="form-control" required="" placeholder="Masukkan Twitter" value="<?= $toko['twitter'] ?>">
                                    <div class="invalid-feedback">
                                        Twitter tidak valid
                                    </div>
                                    <?= form_error('twitter', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="summernote-simple"><?= $toko['deskripsi'] ?></textarea>
                                    <div class="invalid-feedback">
                                        Deskripsi tidak valid
                                    </div>
                                    <?= form_error('deskripsi', '<small class="text-danger pl-3">', '</small>'); ?>
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