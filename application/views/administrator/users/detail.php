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
                <div class="breadcrumb-item active"><a href="#">Users</a></div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, <?= $users['nama_lengkap']; ?></h2>
            <p class="section-lead">
                Informasi detail - <?= $users['username']; ?>.
            </p>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img alt="image" src="<?php echo base_url('uploads/profile/') . $users['foto']; ?>" class="rounded-circle profile-widget-picture img-thumbnail">
                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">No Hp</div>
                                    <div class="profile-widget-item-value"><?= $users['no_telp']; ?></div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Email</div>
                                    <div class="profile-widget-item-value"><?= $users['email']; ?></div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Status</div>
                                    <div class="profile-widget-item-value"><?= $users['is_active'] ? "<div class='badge badge-success'>Aktif</div>" : "<div class='badge badge-danger'>Tidak aktif</div>" ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name"><?= $users['nama_lengkap']; ?> <div class="text-muted d-inline font-weight-normal">
                                    <div class="slash"></div> <?= $users['level']; ?>
                                </div>
                            </div>
                            Administrator.
                            <br>
                            <div class="float-right">
                                <a href="<?php echo base_url(); ?>admin/users/add/<?= $users['id'] ?>" class="btn btn-lg btn-success mr-2 "> Edit</a>
                                <a href="<?php echo base_url(); ?>admin/users/delete/<?= $users['id'] ?>" onclick="return confirmDel()" class="btn btn-lg btn-danger">Delete</a>
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