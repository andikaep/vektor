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
                            <a href="<?= base_url() ?>admin/web/rekening/add">
                                <button class="btn btn-primary">Tambah Rekening</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Bank</th>
                                        <th>Nomor Rekening</th>
                                        <th>Pemilik Rekening</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    $no = 1;
                                    foreach ($rekening as $r) :
                                        ?>
                                        <tr class="even">
                                            <td><?= $no ?></td>
                                            <td><?= $r['nama_bank'] ?></td>
                                            <td><?= $r['no_rekening'] ?></td>
                                            <td><?= $r['pemilik_rekening'] ?></td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>admin/web/rekening/add/<?= $r['id'] ?>" class="btn btn-success"> Edit</a>
                                                <a href="<?php echo base_url(); ?>admin/web/rekening/delete/<?= $r['id'] ?>" onclick="return confirmDel()" class="btn btn-danger">Delete</a>
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