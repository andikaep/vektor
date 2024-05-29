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
                            <a href="<?= base_url() ?>admin/modul/kategori/add">
                                <button class="btn btn-primary">Tambah Kategori</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Kategori Utama</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    $no = 1;
                                    foreach ($kategori as $k) :
                                        $kategoriutama = "Kategori Utama";
                                        if ($k['id_parent'] > 0) {
                                            foreach ($kategori as $key) {
                                                if ($k['id_parent'] == $key['id']) {
                                                    $kategoriutama = $key['nama_kategori'];
                                                }
                                            }
                                        }
                                        ?>
                                        <tr class="even">
                                            <td><?= $no ?></td>
                                            <td><?= $k['nama_kategori'] ?></td>
                                            <td><?= $kategoriutama; ?></td>
                                            <td><?= $k['is_active'] ? "<div class='badge badge-success'>Aktif</div>" : "<div class='badge badge-danger'>Tidak aktif</div>" ?></td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>admin/modul/kategori/add/<?= $k['id'] ?>" class="btn btn-success"> Edit</a>
                                                <a href="<?php echo base_url(); ?>admin/modul/kategori/delete/<?= $k['id'] ?>" onclick="return confirmDel()" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                        $no++;
                                    endforeach;
                                    ?>

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