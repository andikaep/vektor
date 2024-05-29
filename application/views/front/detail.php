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
                    <a href="<?= base_url(); ?>">Orders</a>
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
            Detail Orders
        </h3>

        <div class="checkout-right">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-2">
                        <div class="card-header">
                            <h4 class="float-left tittle-w3l">
                                Invoice <?= $invoice['kode_transaksi'] ?>
                            </h4>
                            <?php
                            if ($invoice['proses'] == '0') {
                                $proses = '<i class="badge badge-danger">Menunggu Konfirmasi</i>';
                            } elseif ($invoice['proses'] == '1') {
                                $proses = '<i class="badge badge-warning text-white">Validasi Konfirmasi</i>';
                            } elseif ($invoice['proses'] == '2') {
                                $proses = '<i class="badge badge-info">Pengiriman</i>';
                            } else {
                                $proses = '<i class="badge badge-success">Selesai </i>';
                            }
                            ?>
                            <h4 class="float-right"><?= $proses ?></h4>
                        </div>

                        <div class="checkout-right">
                            <div class="card-body">

                                <!-- Tabel Orders -->
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
                                                <td>
                                                    <img src="<?= base_url('uploads/produk/') . $c['gambar'] ?>" width="50px" height="50px">
                                                    <?= $c['nama_produk'] ?>
                                                </td>
                                                <td>Rp. <?= rupiah($c['harga_jual'] - $c['diskon']) ?></td>
                                                <td><?= $c['qty'] ?></td>
                                                <td><?= $c['subberat'] ?> gr</td>
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
                                            <td colspan='5'><b>Biaya Pengiriman dengan <?= strtoupper($invoice['kurir']) . ", Layanan : " . $invoice['service'] ?></b></td>
                                            <td><b>Rp. <?= $invoice['ongkir'] ?></b></td>
                                        </tr>
                                        <tr class="bg bg-danger text-white">
                                            <td colspan='5'><b>Total Tagihan </b> <i class='pull-right'><?= terbilang(array_sum(array_column($cart, 'subtotal')) + $invoice['ongkir']); ?> Rupiah</i> </td>
                                            <td><b>Rp. <?= rupiah(array_sum(array_column($cart, 'subtotal')) + $invoice['ongkir']); ?></b></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <?php if ($invoice['proses'] != 0 && $konfirmasi != null) : ?>
                                    <!-- Tavbel Transfer -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-md">
                                            <thead>
                                                <tr>
                                                    <th colspan='3'>
                                                        <b>Detail Transfer</b>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tr>
                                                <td width="20%">Nama Pengirim</td>
                                                <td width="40%"><?= $konfirmasi['nama_pengirim']; ?></td>
                                                <td class="text-center" width="40%">Bukti Transfer</td>
                                            </tr>
                                            <tr>
                                                <td width="20%">Total Transfer</td>
                                                <td width="40%">Rp. <?= rupiah($konfirmasi['total_transfer']); ?></td>
                                                <td rowspan='4' width="40%" class="text-center">
                                                    <img alt="image" src="<?php echo base_url('uploads/bukti-transfer/') . $konfirmasi['bukti_transfer']; ?>" style="max-width:400px; max-height:140px">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="20%">Rekening Tujuan</td>
                                                <td width="40%"><?= $rekening['nama_bank'] . " - " . $rekening['no_rekening']; ?></td>
                                            </tr>
                                            <tr>
                                                <td width="20%">Waktu Konfirmasi</td>
                                                <td width="40%"><?= date('h:i:s d F Y', strtotime($konfirmasi['waktu_konfirmasi'])); ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-footer pb-3">
                                <?php if ($invoice['proses'] == '0') : ?>
                                    <a href="<?= base_url("penjualan/konfirmasi/$invoice[kode_transaksi]"); ?>" class="btn btn-success"><i class="fas fa-money-bill-alt"></i> Konfirmasi Pembayaran</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('front/templates/footer');
?>