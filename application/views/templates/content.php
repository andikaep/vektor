<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/header');
$this->load->view('templates/layout');
$this->load->view('templates/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-archive"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Transaksi</h4>
            </div>
            <div class="card-body">
              <?= count($penjualan) ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Pemasukkan</h4>
            </div>
            <div class="card-body">
              Rp. <?= rupiah(array_sum(array_column($penjualan, 'total_belanja'))) ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-shopping-bag"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Terjual</h4>
            </div>
            <div class="card-body">
              <?= count($penjualan_detail) ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>List Orders</h4>
            <div class="card-header-action">
              <a href="<?= base_url('admin/transaksi/orders') ?>" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive table-invoice">
              <table class="table table-striped">
                <tr>
                  <th>ID Transaksi</th>
                  <th>Customer</th>
                  <th>Status</th>
                  <th>Tanggal Belanja</th>
                  <th>Action</th>
                </tr>
                <?php foreach ($orders as $o) :
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
                  <tr>
                    <td><a href="<?= base_url('admin/transaksi/orders/detail/') . $o['kode_transaksi'] ?>"><?= $o['kode_transaksi'] ?></a></td>
                    <td class="font-weight-600"><?= $o['username'] ?></td>
                    <td>
                      <?= $proses ?>
                    </td>
                    <td><?= tgl_indo($o['waktu_transaksi']) ?></td>
                    <td>
                      <a href="<?= base_url('admin/transaksi/orders/detail/') . $o['kode_transaksi'] ?>" class="btn btn-primary">Detail</a>
                    </td>
                  <?php endforeach; ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('templates/footer'); ?>