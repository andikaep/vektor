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
                <div class="breadcrumb-item active"><a href="#">Konfirmasi</a></div>
                <div class="breadcrumb-item"><a href="#"><?= $title ?></a></div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title"><?= $title ?></h2>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <?php echo $this->session->flashdata("message"); ?>
                        <div class="card-body">
                            <?php
                            if ($detail['proses'] == '0') {
                                $color = 'danger';
                                $colorhex = '#fc544b';
                                $text = 'Menunggu Konfirmasi';
                            } elseif ($detail['proses'] == '1') {
                                $color = 'warning';
                                $colorhex = '#ffa426';
                                $text = 'Validasi Konfirmasi';
                            } elseif ($detail['proses'] == '2') {
                                $color = 'info';
                                $colorhex = '#3abaf4';
                                $text = 'Pengiriman';
                            } else {
                                $color = 'success';
                                $colorhex = '#63ed7a';
                                $text = 'Selesai';
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-8">
                                    <dl class='row dl-horizontal'>
                                        <dt class="text-right col-sm-4">Nama Pembeli</dt>
                                        <dd class="col-sm-8"><?= $detail['nama_lengkap'] ?></dd>
                                        <dt class="text-right col-sm-4">No Telpon/Hp</dt>
                                        <dd class="col-sm-8"><?= $detail['no_telp'] ?></dd>
                                        <dt class="text-right col-sm-4">Email</dt>
                                        <dd class="col-sm-8"><?= $detail['email'] ?></dd>
                                        <dt class="text-right col-sm-4">Kota</dt>
                                        <dd class="col-sm-8"><?= $detail['nama_kota'] ?></dd>
                                        <dt class="text-right col-sm-4">Alamat Lengkap</dt>
                                        <dd class="col-sm-8"><?= $detail['alamat_lengkap'] ?></dd>
                                    </dl>
                                </div>
                                <div class="col-md-4 justify-content-md-center">
                                    <div class="mt-1 mb-4">
                                        <h5 class="text-center">
                                            Total Tagihan
                                        </h5>
                                        <h4 class="text-center">
                                            Rp. <?= rupiah($totalakhir + $detail['ongkir']); ?>
                                        </h4>
                                    </div>
                                    <div>
                                        <h5 class="text-center">
                                            <?= strtoupper($detail['kurir']) . " - " . $detail['service']  ?>
                                        </h5>
                                        <p class="text-center">
                                            Status : <i><span class="badge badge-<?= $color ?>"><?= $text ?></span></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
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
                                        <td width="40%"><?= $detail['nama_pengirim']; ?></td>
                                        <td class="text-center" width="40%">Bukti Transfer</td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Total Transfer</td>
                                        <td width="40%"><?= $detail['total_transfer']; ?></td>
                                        <td rowspan='4' width="40%">
                                            <img alt="image" src="<?php echo base_url('uploads/bukti-transfer/') . $detail['bukti_transfer']; ?>" style="max-width:400px; max-height:140px">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Rekening Tujuan</td>
                                        <td width="40%"><?= $rekening['nama_bank'] . " - " . $rekening['no_rekening']; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="20%">Waktu Konfirmasi</td>
                                        <td width="40%"><?= date('h:i:s d F Y', strtotime($detail['waktu_konfirmasi'])); ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <thead>
                                        <tr>
                                            <th width='30px'>No</th>
                                            <th width='47%'>Nama Produk</th>
                                            <th>Harga - Diskon</th>
                                            <th>Qty</th>
                                            <th>Berat</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($produk as $p) :
                                            ?>
                                            <tr class="even">
                                                <td><?= $no ?></td>
                                                <td><?= $p['nama_produk'] ?></td>
                                                <td><?= rupiah($p['harga_jual'] - $p['diskon']) ?></td>
                                                <td><?= $p['jumlah'] ?></td>
                                                <td><?= $p['jumlah'] * $p['berat'] ?> Gram</td>
                                                <td><?= rupiah(($p['harga_jual'] - $p['diskon']) * $p['jumlah']) ?></td>
                                            </tr>
                                            <?php
                                            $no++;
                                        endforeach;
                                        ?>
                                        <tr class='success'>
                                            <td colspan='4'><b>Jumlah</b></td>
                                            <td><b><?= $totalberat ?> Gram</b></td>
                                            <td><b>Rp. <?= rupiah($totalakhir) ?></b></td>
                                        </tr>
                                        <tr class='success'>
                                            <td colspan='5'><b>Biaya Pengiriman</b></td>
                                            <td><b>Rp. <?= rupiah($detail['ongkir']) ?></b></td>
                                        </tr>
                                        <tr style='background-color:<?= $colorhex ?>; color:white '>
                                            <td colspan='5'><b>Total Tagihan </b> <i class='pull-right'><?= terbilang($totalakhir + $detail['ongkir']); ?> Rupiah</i> </td>
                                            <td><b>Rp. <?= rupiah($totalakhir + $detail['ongkir']); ?></b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    function confirmDel() {
        return confirm("Anda Yakin?");
    }
</script>
<?php $this->load->view('templates/footer'); ?>