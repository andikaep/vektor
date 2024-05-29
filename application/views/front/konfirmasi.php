<?php

// var_dump
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('front/templates/header');
$this->load->view('front/templates/topheader');
$this->load->view('front/templates/navigation');
// $this->load->view('front/templates/bannerpage');
?>

<!-- page -->
<div class="services-breadcrumb">
    <div class="agile_inner_breadcrumb">
        <div class="container">
            <ul class="w3_short">
                <li>
                    <a href="<?= base_url(); ?>">Checkout</a>
                    <i>|</i>
                </li>
                <li>Konfirmasi Transfer</li>
            </ul>
        </div>
    </div>
</div>
<!-- //page -->

<!-- Konfirmasi page -->
<div class=" privacy p-2 mb-3">
    <div class="container">
        <div class="checkout-left">
            <div class="row justify-content-center">
                <div class="col-lg-8 address_form_agile mt-4">
                    <h4 class="mb-sm-4 mb-3">Konfirmasi Pembayaran <strong><?= $invoice ?></strong></h4>
                    <form action="<?= base_url("penjualan/konfirmasi/$invoice") ?>" method="post" class="creditly-card-form agileinfo_form" enctype="multipart/form-data">
                        <div class="creditly-wrapper wthree, w3_agileits_wrapper">
                            <div class="information-wrapper">
                                <div class="first-row">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="controls form-group">
                                                <input class="billing-address-name form-control" type="text" name="nama_pengirim" placeholder="Nama Pengirim" required="">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="controls form-group">
                                                <input class="billing-address-name form-control" type="text" name="norek_pengirim" placeholder="Nomor Rekening" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="controls form-group">
                                        <input class="billing-address-name form-control" type="text" name="bank_pengirim" placeholder="Bank Rekening Pengirim" required="">
                                    </div>
                                    <div class="controls form-group">
                                        <input class="billing-address-name form-control" type="number" name="total_transfer" placeholder="Jumlah Transfer" required="">
                                    </div>
                                    <div class="controls form-group mb-0">
                                        <select class="controls form-group" id="rekening" name="rekening">
                                            <option value="0"> -- PILIH REKENING BANK TUJUAN --</option>
                                            <?php foreach ($rekening as $rek) : ?>
                                                <option value="<?= $rek['id']; ?>"><?= $rek['nama_bank']; ?> - <?= $rek['no_rekening']; ?> - An. <?= $rek['pemilik_rekening']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Bukti Transfer</label>
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="controls form-group">
                                                        <input type="file" class="form-control " id="image" name="image" onchange="previewImage();">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 text-center">
                                                    <img id="image-preview" style="display:none" width="120px" height="120px" class="img-thumbnail">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" class="submit check_out btn">Konfirmasi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //checkout page -->

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

<?php $this->load->view('front/templates/footer'); ?>