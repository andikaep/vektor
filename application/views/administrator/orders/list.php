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
                <div class="breadcrumb-item active"><a href="#"><?= $title ?></a></div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title"><?= $title ?></h2>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <?php echo $this->session->flashdata("message"); ?>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md datatable">
                                    <thead>
                                        <tr>
                                            <th width="20px">No</th>
                                            <th>Kode Transaksi</th>
                                            <th>Customer</th>
                                            <th>Total Belanja</th>
                                            <th>Waktu Transaksi</th>
                                            <th>Status</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($orders as $o) :
                                            if ($o['proses'] == '0') {
                                                $proses = '<i class="badge badge-danger">Menuggu Konfirmasi</i>';
                                                $color = 'danger';
                                                $text = 'Menuggu Konfirmasi';
                                            } elseif ($o['proses'] == '1') {
                                                $proses = '<i class="badge badge-warning">Validasi Konfirmasi</i>';
                                                $color = 'warning';
                                                $text = 'Validasi Konfirmasi';
                                            } elseif ($o['proses'] == '2') {
                                                $proses = '<i class="badge badge-info">Pengiriman</i>';
                                                $color = 'info';
                                                $text = 'Pengiriman';
                                            } else {
                                                $proses = '<i class="badge badge-success">Selesai </i>';
                                                $color = 'success';
                                                $text = 'Selesai';
                                            }
                                            ?>
                                            <tr class="even">
                                                <td><?= $no ?></td>
                                                <td><a href="<?= base_url('admin/transaksi/orders/detail/') . $o['kode_transaksi'] ?>"><?= $o['kode_transaksi'] ?></a></td>
                                                <td><?= $o['username'] ?></td>
                                                <td>Rp. <?= rupiah($o['total_belanja'] + $o['ongkir']) ?></td>
                                                <td><?= tgl_indo($o['waktu_transaksi']) ?></td>
                                                <td><?= $proses ?></td>
                                                <td>
                                                    <a href="<?= base_url('admin/transaksi/orders/detail/') . $o['kode_transaksi'] ?>" class="btn btn-primary">Detail</a>
                                                </td>
                                            </tr>
                                            <?php
                                            $no++;
                                        endforeach;
                                        ?>
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