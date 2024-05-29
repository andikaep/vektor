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
                <div class="breadcrumb-item active"><a href="#">Menu</a></div>
                <div class="breadcrumb-item"><?= $title ?></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title"><?= $title ?></h2>
            <div class="row">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="card">
                        <form class="needs-validation" novalidate="" method="POST" action="<?= base_url() ?>admin/modul/produk/add" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Produk</label>
                                    <input type="text" name="nama_produk" class="form-control" required="" placeholder="Masukkan nama produk">
                                    <div class="invalid-feedback">
                                        Nama produk tidak valid
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori Produk</label>
                                    <select class="form-control" name="kategori" id="kategori" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php foreach ($kategori as $key) : ?>
                                            <option value="<?= $key['id'] ?> "><?= $key['nama_kategori'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Kategori produk tidak valid
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="text" name="satuan" class="form-control" placeholder="Masukkan satuan produk">
                                    <div class="invalid-feedback">
                                        Satuan produk tidak valid
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Harga Beli</label>
                                    <input type="number" name="harga_beli" class="form-control" placeholder="Masukkan harga beli produk">
                                    <div class="invalid-feedback">
                                        Harga beli produk tidak valid
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Harga Reseller</label>
                                    <input type="number" name="harga_reseller" class="form-control" placeholder="Masukkan harga reseller produk">
                                    <div class="invalid-feedback">
                                        Harga reseller produk tidak valid
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Harga Jual</label>
                                    <input type="number" name="harga_jual" class="form-control" placeholder="Masukkan harga jual produk">
                                    <div class="invalid-feedback">
                                        Harga jual produk tidak valid
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="number" name="stok" class="form-control" placeholder="Masukkan stok produk">
                                    <div class="invalid-feedback">
                                        Stok produk tidak valid
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Berat (gram)</label>
                                    <input type="number" name="berat" class="form-control" placeholder="Masukkan berat produk">
                                    <div class="invalid-feedback">
                                        Berat produk tidak valid
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Diskon (Rupiah)</label>
                                    <input type="number" name="diskon" class="form-control" placeholder="Masukkan diskon produk">
                                    <div class="invalid-feedback">
                                        Diskon produk tidak valid
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <label>Gambar</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <img id="image-preview" width="120px" height="120px" class="rounded-circle">
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="image" name="image" onchange="previewImage();">
                                                    <label class="custom-file-label" for="image">Pilih Gambar</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="summernote-simple" name="keterangan"></textarea>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    function previewImage() {
        document.getElementById("image-preview").style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("image").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("image-preview").src = oFREvent.target.result;
        };
    };
</script>
<?php $this->load->view('templates/footer'); ?>
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>