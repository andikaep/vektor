<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('front/templates/header');
$this->load->view('front/templates/topheader');
$this->load->view('front/templates/navigation');
// $this->load->view('front/templates/bannerpage');
?>

<!-- page -->
<div class="services-breadcrumb">
    <div class="agile_inner_breadcrumb">
        <div class="container">
            <ul class="w3_short">
                <li>
                    <a href="<?= base_url(); ?>">Home</a>
                    <i>|</i>
                </li>
                <li>Profile</li>
            </ul>
        </div>
    </div>
</div>
<!-- //page -->

<!-- Profile page -->
<div class="privacy py-sm-5 py-4">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <?= $this->session->flashdata('message') ?>
        <div class="row">
            <div class=" col-lg-6 card mb-3" style="height:270px;">
                <div class="row no-gutters">
                    <div class="col-4  mt-3">
                        <img src="<?= base_url('uploads/profile/') . $profile['foto'] ?>" class="img-hp card-img" />
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $profile['nama_lengkap'] ?> - <span class="text-muted"><i><?= strtoupper($profile['username']) ?></i></span></h5>
                            <dl class='row dl-horizontal'>
                                <dt class="col-lg-3 col-md-3 col-sm-4 col-xs-5">No Hp:</dt>
                                <dd class="col-lg-9 col-md-9 col-sm-8 col-xs-7"><?= $profile['no_telp'] ?></dd>
                                <dt class="col-lg-3 col-md-3 col-sm-4 col-xs-5">Email:</dt>
                                <dd class="col-lg-9 col-md-9 col-sm-8 col-xs-7"><?= $profile['email'] ?></dd>
                            </dl>
                            <p class="card-text"><small class="text-muted">Terdaftar <?= tgl_indo($profile['tanggal_daftar']) ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row mb-2">
                    <div class="col-6">
                        <h5>Alamat Pengiriman</h5>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modalAlamat"><i class="fas fa-plus"></i> Penerima & alamat</button>
                    </div>
                </div>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Kota</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($alamat == null) : ?>
                            <tr>
                                <th colspan="3" class="text-center">Anda belum memiliki alamat pengirim</th>
                            </tr>
                        <?php else : ?>
                            <?php
                            $no = 1;
                            foreach ($alamat as $al) :
                                $data = $this->global_mod->view_where('kota', ['id' => $al['id_kota']])->row_array();
                                ?>
                                <tr>
                                    <th scope="row"><?= $no ?></th>
                                    <td><?= $al['alamat_pengiriman'] ?></td>
                                    <td><?= $data['nama_kota'] ?></td>
                                </tr>
                                <?php
                                $no++;
                            endforeach;
                            ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h5>Riwayat Transaksi</h5>
                <table class="table mt-2">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Koda Transaksi</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Tujuan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Konfirmasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($penjualan == null) : ?>
                            <tr>
                                <th colspan="5" class="text-center">Tidak ada riwayat transaksi</th>
                            </tr>
                        <?php else : ?>
                            <?php
                            $no = 1;
                            foreach ($penjualan as $p) :
                                if ($p['proses'] == '0') {
                                    $proses = '<i class="badge badge-danger">Menunggu Konfirmasi</i>';
                                } elseif ($p['proses'] == '1') {
                                    $proses = '<i class="badge badge-warning text-white">Validasi Konfirmasi</i>';
                                } elseif ($p['proses'] == '2') {
                                    $proses = '<i class="badge badge-info">Pengiriman</i>';
                                } else {
                                    $proses = '<i class="badge badge-success">Selesai </i>';
                                }
                                $alamat_tujuan = $this->global_mod->view_where('alamat_pengiriman_konsumen', ['id' => $p['id_alamat_pengiriman_konsumen']])->row_array();

                                ?>
                                <tr>
                                    <th scope="row"><?= $no ?></th>
                                    <td><a href="<?= base_url('penjualan/detail/') . $p['kode_transaksi'] ?>"><strong><?= $p['kode_transaksi'] ?></strong></a></td>
                                    <td><?= tgl_indo($p['waktu_transaksi']) ?></td>
                                    <td><?= $alamat_tujuan['alamat_pengiriman'] ?></td>
                                    <td><?= $proses ?></td>
                                    <td>
                                        <?php if ($p['proses'] != '0') : ?>
                                            <button class="btn btn-danger" disabled>Konfirmasi</button>
                                        <?php else : ?>
                                            <a href="<?= base_url('penjualan/konfirmasi/') . $p['kode_transaksi']  ?>"><button class="btn btn-success">Konfirmasi</button></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                                $no++;
                            endforeach;
                            ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- //Profile page -->

<div class="modal fade" id="modalAlamat" tabindex="-1" role="dialog" aria-labelledby="modalAlamatLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Form tambah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('konsumen/alamat'); ?>" method="post">
                    <div class="form-group">
                        <label class="col-form-label">Nama Penerima</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required="" value="<?= $this->session->userdata('username_konsumen') ?>">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat" required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Kota</label>
                        <div class="controls form-group mb-0">
                            <select class="form-control form-group" name="kota_add" required>
                                <option value="0"> -- PILIH KOTA --</option>
                                <?php
                                foreach ($kota as $ko) : ?>
                                    <option value="<?= $ko['id']; ?>"><?= $ko['nama_kota']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="right-w3l">
                        <button type="submit" class="btn btn-primary form-control">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('front/templates/footer'); ?>