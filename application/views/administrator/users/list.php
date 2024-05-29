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
                            <a href="<?= base_url() ?>admin/users/add">
                                <button class="btn btn-primary">Tambah User</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md datatable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>No Telphone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($users as $u) :
                                            ?>
                                            <tr class="even">
                                                <td><?= $no ?></td>
                                                <td><?= $u['username'] ?></td>
                                                <td><?= $u['nama_lengkap'] ?></td>
                                                <td><?= $u['email'] ?></td>
                                                <td><?= $u['no_telp'] ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>admin/users/add/<?= $u['id'] ?>" class="btn btn-xs btn-success"> Edit</a>
                                                    <a href="<?php echo base_url(); ?>admin/users/detail/<?= $u['id'] ?>" class="btn btn-xs btn-info"> Detail</a>
                                                    <a href="<?php echo base_url(); ?>admin/users/delete/<?= $u['id'] ?>" onclick="return confirmDel()" class="btn btn-xs btn-danger">Delete</a>
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
</div>
</section>
</div>
<script>
    function confirmDel() {
        return confirm("Anda Yakin?");
    }
</script>
<?php $this->load->view('templates/footer'); ?>