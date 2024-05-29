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
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Website</th>
                                        <th>Nama Singkat</th>
                                        <th>Logo</th>
                                        <th>Footer</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php $no = 1; ?>
                                    <tr class="even">
                                        <td><?= $no ?></td>
                                        <td><?= $web['nama_website'] ?></td>
                                        <td><?= $web['nama_website_singkat'] ?></td>
                                        <td><img src="<?= base_url('uploads/') . $web['logo_website'] ?>" width="100" /></td>
                                        <td><?= $web['footer_website'] ?></td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>admin/web/website/edit/<?= $web['id'] ?>" class="btn btn-success"> Edit</a>
                                        </td>
                                    </tr>
                                    <?php $no++; ?>
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
<?php $this->load->view('templates/footer'); ?>