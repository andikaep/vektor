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
                <div class="breadcrumb-item active"><a href="#">Rekening</a></div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title"><?= $title ?></h2>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <form class="needs-validation" novalidate="" method="POST" action="<?= base_url() ?>admin/web/rekening/add">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Bank</label>
                                    <input type="text" name="nama_bank" class="form-control" required="" placeholder="Masukkan nama bank">
                                    <div class="invalid-feedback">
                                        Nama bank tidak valid
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nomor Rekening</label>
                                    <input type="text" name="no_rekening" class="form-control" required="" placeholder="Masukkan nomor rekening">
                                    <div class="invalid-feedback">
                                        Nomor rekening tidak valid
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Pemilik Rekening</label>
                                    <input type="text" name="pemilik_rekening" class="form-control" required="" placeholder="Masukkan pemilik rekening">
                                    <div class="invalid-feedback">
                                        Pemilik rekening tidak valid
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