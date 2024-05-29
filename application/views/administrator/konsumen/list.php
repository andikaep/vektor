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
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>No Telphone</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($konsumen as $k) :
                                            ?>
                                            <tr class="even">
                                                <td><?= $no ?></td>
                                                <td><?= $k['username'] ?></td>
                                                <td><?= $k['nama_lengkap'] ?></td>
                                                <td><?= $k['email'] ?></td>
                                                <td><?= $k['no_telp'] ?></td>
                                                <td><?= $k['is_active'] ? "<div class='badge badge-success'>Aktif</div>" : "<div class='badge badge-danger'>Tidak aktif</div>" ?></td>
                                                <td>
                                                    <?php if ($k['is_active'] == 0) : ?>
                                                        <button type="button" class="btn btn-xs btn-danger" disabled>Non-Active</button>
                                                    <?php else : ?>
                                                        <a href="<?php echo base_url(); ?>admin/modul/konsumen/nonaktif/<?= $k['id'] ?>" class="btn btn-xs btn-danger"> Non-Active</a>
                                                    <?php endif; ?>
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