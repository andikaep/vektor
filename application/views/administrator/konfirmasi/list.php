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
                                            <th>Total Transfer</th>
                                            <th>Dari Rekening</th>
                                            <th>Ke Rekening</th>
                                            <th>Konfirmasi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($konfirmasi as $k) :
                                            if ($k['proses'] == '0') {
                                                $color = 'danger';
                                                $text = 'Menunggu Pembayaran';
                                            } elseif ($k['proses'] == '1') {
                                                $color = 'warning';
                                                $text = 'Validasi';
                                            } elseif ($k['proses'] == '2') {
                                                $color = 'info';
                                                $text = 'Pengiriman';
                                            } else {
                                                $color = 'success';
                                                $text = 'Selesai';
                                            }
                                            ?>
                                            <tr class="even">
                                                <td><?= $no ?></td>
                                                <td><?= $k['kode_transaksi'] ?></td>
                                                <td>Rp. <?= rupiah($k['total_transfer']) ?></td>
                                                <td><?= $k['nama_pengirim'] ?></td>
                                                <td><?= $k['nama_bank'] ?></td>
                                                <td>
                                                    <div class='btn-group'>
                                                        <button style='width:100px' type='button' class='btn btn-<?= $color ?> btn-xs'><?= $text ?>
                                                        </button>
                                                        <?php if ($k['proses'] <= '3') : ?>
                                                            <button class='btn btn-<?= $color ?> btn-xs dropdown-toggle' data-toggle='dropdown'>
                                                                <span class='caret'></span>
                                                                <span class='sr-only'>Toggle Dropdown</span>
                                                            </button>
                                                            <ul class='dropdown-menu' style='border:1px solid #cecece;'>
                                                                <?php

                                                                $pros = ['Ditolak', 'Pengiriman', 'Selesai'];
                                                                for ($i = 0; $i <= 1; $i++) :
                                                                    ?>
                                                                    <a class="dropdown-item" href='<?= base_url('admin/transaksi/orders/orders_status/') . $k['id_penjual'] . "/" . ($i + 3) ?>' onclick="return confirm('Apa anda yakin untuk ubah status jadi <?= $pros[$i] ?> ?')"> <?= $pros[$i] ?></a>
                                                                <?php
                                                                endfor;
                                                            endif;
                                                            ?>
                                                        </ul>
                                                    </div>
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