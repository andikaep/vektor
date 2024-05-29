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
                            <a href="<?= base_url() ?>admin/menu/add">
                                <button class="btn btn-primary">Tambah Menu</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Menu</th>
                                        <th>Menu Utama</th>
                                        <th>Link</th>
                                        <th>Icon</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    $no = 1;
                                    foreach ($menuadmin as $menu) :
                                        $menuutama = "Menu Utama";
                                        if ($menu['id_parent'] > 0) {
                                            foreach ($menuadmin as $key) {
                                                if ($menu['id_parent'] == $key['id']) {
                                                    $menuutama = $key['nama_menu'];
                                                }
                                            }
                                        }

                                        ?>
                                        <tr class="even">
                                            <td><?= $no ?></td>
                                            <td><?= $menu['nama_menu'] ?></td>
                                            <td><?= $menuutama ?></td>
                                            <td><?= $menu['link_menu'] ?></td>
                                            <td><?= $menu['icon_menu'] ?></td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>admin/menu/edit/<?= $menu['id'] ?>" class="btn btn-success"> Edit</a>
                                                <a href="<?php echo base_url(); ?>admin/menu/delete/<?= $menu['id'] ?>" onclick="return confirmDel()" class="btn btn-danger">Delete</a>
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