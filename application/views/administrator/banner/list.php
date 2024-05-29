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
                            <a href="<?= base_url() ?>admin/web/banner/add">
                                <button class="btn btn-primary mr-2">Tambah Banner</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Banner</th>
                                        <th>Keterangan</th>
                                        <th>Link</th>
                                        <th>Gambar</th>
                                        <th>Urutan</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php $no = 1;
                                    foreach ($banners as $banner) :
                                        ?>
                                        <tr class="even">
                                            <td><?= $no ?></td>
                                            <td><?= $banner['judul_banner'] ?></td>
                                            <td><?= $banner['keterangan_banner'] ?></td>
                                            <td><?= $banner['link_banner'] ?></td>
                                            <td><img src="<?= base_url('uploads/banner/') . $banner['gambar_banner'] ?>" width="100" /></td>
                                            <!-- <td><?= $banner['urutan_banner'] ?></td> -->
                                            <td>
                                                <div class='btn-group'>
                                                    <button style='width:50px' type='button' class='btn btn-info btn-xs'><?= $banner['urutan_banner'] ?></button>
                                                    <button class='btn btn-info btn-xs dropdown-toggle' data-toggle='dropdown'> <span class='caret'></span> <span class='sr-only'>Toggle Dropdown</span> </button>
                                                    <ul class='dropdown-menu' style='border:1px solid #cecece;'>
                                                        <?php
                                                        for ($i = 1; $i <= count($banners); $i++) :
                                                            if ($banner['urutan_banner'] != $i) :
                                                                ?>
                                                                <a class="dropdown-item" href='<?= base_url('admin/web/banner/sort/') . $banner['id'] . "/" . $i ?>'>Ubah ke <?= $i ?></a>
                                                            <?php
                                                        endif;
                                                    endfor;
                                                    ?>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>admin/web/banner/add/<?= $banner['id'] ?>" class="btn btn-success"> Edit</a>
                                                <a href="<?php echo base_url(); ?>admin/web/banner/delete/<?= $banner['id'] ?>" onclick="return confirmDel()" class="btn btn-xs btn-danger">Delete</a>
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