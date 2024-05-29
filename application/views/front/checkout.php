<?php

// var_dump
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
                    <a href="<?= base_url(); ?>">Checkout</a>
                    <i>|</i>
                </li>
                <li>Detail</li>
            </ul>
        </div>
    </div>
</div>
<div class="privacy">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-5">
            Checkout
        </h3>

        <div class="checkout-right">
            <?= $this->session->flashdata("message") ?>
            <div class="row">
                <div class="col-lg-4 address_form_agile">
                    <a class="mb-sm-4 mb-3" data-toggle="modal" data-target="#alamat"><button class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Penerima & alamat</button></a>
                    <form action="<?= base_url('penjualan/add') ?>" method="POST">
                        <div class="creditly-wrapper wthree, w3_agileits_wrapper">
                            <div class="information-wrapper">
                                <div class="first-row">
                                    <div class="controls form-group mb-0">
                                        <select class="controls form-group" id="kota_alamat" name="kota_alamat">
                                            <option value="0"> -- PILIH ALAMAT PENERIMA --</option>
                                            <?php foreach ($alamat_pengiriman_konsumen as $a) : ?>
                                                <option value="<?= $a['id']; ?>"><?= $a['nama_penerima'] . " - " . $a['alamat_pengiriman']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="controls form-group mb-0">
                                        <select class="controls form-group" id="kurir" name="kurir">
                                            <option value="0"> -- PILIH KURIR --</option>
                                            <option value="jne">JNE</option>
                                            <option value="pos">POS</option>
                                            <option value="tiki">TIKI</option>
                                        </select>
                                    </div>
                                    <div class="controls form-group mb-0">
                                        <select class="controls form-group" id="layanan" name="layanan">
                                            <option value="0"> -- PILIH LAYANAN --</option>
                                        </select>
                                    </div>
                                    <button type='submit' class="btn btn-danger">Buat Pesanan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-8">
                    <div class="float-right mb-3">
                        <a href="" class="btn btn-danger"><i class="fas fa-print"></i> Cetak Invoice</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <thead>
                                <tr>
                                    <th width='30px'>No</th>
                                    <th width='47%'>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Berat</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($cart as $c) :
                                    ?>
                                    <tr class="even">
                                        <td><?= $no ?></td>
                                        <td><?= $c['nama_produk'] ?></td>
                                        <td><?= rupiah($c['harga_jual'] - $c['diskon']) ?></td>
                                        <td><?= $c['qty'] ?></td>
                                        <td><?= $c['subberat'] ?></td>
                                        <td>Rp. <?= rupiah($c['subtotal']) ?></td>
                                    </tr>
                                    <?php
                                    $no++;
                                endforeach;
                                ?>
                                <tr class='success'>
                                    <td colspan='4'><b>Jumlah</b></td>
                                    <td><b><?= array_sum(array_column($cart, 'subberat')); ?> gr</b></td>
                                    <td><b>Rp. <?= rupiah(array_sum(array_column($cart, 'subtotal'))) ?></b></td>
                                </tr>
                                <tr class='success'>
                                    <td colspan='5'><b>Biaya Pengiriman</b></td>
                                    <td><b id="ongkir_dinamis">Rp. 0</b></td>
                                </tr>
                                <tr class="bg bg-danger text-white">
                                    <td colspan='5'><b>Total Tagihan </b> <i class='pull-right' id="terbil_dinamis"><?= terbilang(array_sum(array_column($cart, 'subtotal'))); ?> Rupiah</i> </td>
                                    <td><b id="total_dinamis">Rp. <?= rupiah(array_sum(array_column($cart, 'subtotal'))); ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modals -->
    <!-- alamat -->
    <div class="modal fade" id="alamat" tabindex="-1" role="dialog" aria-hidden="true">
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
</div>
<?php
$total['tot'] = array_sum(array_column($cart, 'subtotal'));
$this->load->view('front/templates/footer', $total);
?>