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
                    <a href="<?= base_url('checkout'); ?>">Checkot</a>
                    <i>|</i>
                </li>
                <li>Transaksi Sukses</li>
            </ul>
        </div>
    </div>
</div>
<div class="privacy">
    <div class="container py-xl-4 py-2">
        <div class="row">
            <div class="col-lg-8 mb-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="tittle-w3l text-center">
                            No Orders : <?= $kode_transaksi ?>
                        </h4>
                    </div>

                    <div class="checkout-right">
                        <?= $this->session->flashdata('messages'); ?>
                        <div class="card-body">
                            <p>Silakan lakukan pembayaran untuk bisa kami proses selanjutnya dengan cara:</p>
                            <ol>
                                <li>Lakukan pembayaran pada salah satu rekening kami </li>
                                <li>Sertakan keterangan dengan nomor order: <strong> <?= $kode_transaksi ?></strong></li>
                                <li>Pengiriman barang melalui : <strong><?= strtoupper($kurir) ?></strong>, Layanan : <?= $service ?></li>
                                <li>Total pembayaran: <strong>Rp. <?= rupiah($total_belanja) ?>,-</strong></li>
                            </ol>
                        </div>
                        <div class="card-footer">
                            <a href="<?= base_url('penjualan/konfirmasi/') . $kode_transaksi; ?>" class="btn btn-success"><i class="fas fa-money-bill-alt"></i> Konfirmasi</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-3" style="max-width: 18rem;">
                    <div class="card-header bg-primary text-white">Data Rekening</div>
                    <div class="card-body">
                        <?php foreach ($rekening as $rek) : ?>
                            <div>
                                <h5 class="card-title mt-1 mb-0"><?= $rek['nama_bank']; ?> - <?= $rek['no_rekening']; ?></h5>
                                <p class="card-text">An <?= $rek['pemilik_rekening']; ?>.</p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
$this->load->view('front/templates/footer');
?>