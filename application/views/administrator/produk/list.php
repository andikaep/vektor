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
                        <div class="card-header">
                            <a href="<?= base_url() ?>admin/modul/produk/add">
                                <button class="btn btn-primary">Tambah Produk</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md datatable">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Gambar</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Reseller</th>
                                            <th>Harga Jual</th>
                                            <th>Stok</th>
                                            <th>Diskon</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        foreach ($produk as $p) :
                                            ?>
                                            <tr class="even">
                                                <td><?= $p['nama_produk'] ?></td>
                                                <td><img src="<?= base_url('uploads/produk/') . $p['gambar'] ?>" width="60px" /></td>
                                                <td><?= $p['harga_beli'] ?></td>
                                                <td><?= $p['harga_reseller'] ?></td>
                                                <td><?= $p['harga_jual'] ?></td>
                                                <td><?= $p['stok'] ?></td>
                                                <td><?= $p['diskon'] ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>admin/modul/produk/add/<?= $p['id'] ?>" class="btn btn-xs btn-success"> Edit</a>
                                                    <a href="<?php echo base_url(); ?>admin/modul/produk/detail/<?= $p['id'] ?>" class="btn btn-xs btn-info"> Detail</a>
                                                    <a href="<?php echo base_url(); ?>admin/modul/produk/delete/<?= $p['id'] ?>" onclick="return confirmDel()" class="btn btn-xs btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        <?php
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
</div>
</section>
</div>
<script>
    function confirmDel() {
        return confirm("Anda Yakin?");
    }
</script>
<?php $this->load->view('templates/footer'); ?>