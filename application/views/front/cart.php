<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('front/templates/header');
$this->load->view('front/templates/topheader');
$this->load->view('front/templates/navigation');
// $this->load->view('front/templates/bannerpage');
?>
<style>
    @media(max-width: 800px) {

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    }
</style>
<!-- page -->
<div class="services-breadcrumb">
    <div class="agile_inner_breadcrumb">
        <div class="container">
            <ul class="w3_short">
                <li>
                    <a href="<?= base_url(); ?>">Beranda Toko</a>
                    <i>|</i>
                </li>
                <li>Detail Belanja</li>
            </ul>
        </div>
    </div>
</div>
<div class="privacy">
    <div class="container py-xl-4 py-2">
        <div class="card">
            <div class="card-header">
                <h3 class="tittle-w3l text-center">
                    Detail Belanja
                </h3>
            </div>

            <div class="checkout-right">
                <?= $this->session->flashdata('messages'); ?>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <thead>
                                <tr>
                                    <th width='30px'>No</th>
                                    <th width='50%'>Produk</th>
                                    <th class="text-center">Qty</th>
                                    <th>Subtotal</th>
                                    <th width='50px text-center'></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($cart as $c) :
                                    ?>
                                    <tr class="even">
                                        <td><?= $no ?></td>
                                        <td> <img src="<?= base_url('uploads/produk/') . $c['gambar']; ?>" height="50px" class="rounded"> <?= $c['nama_produk'] ?></td>
                                        <td width="200px">
                                            <form class="upcart" action="<?= base_url("cart/update_qty") ?>" method="POST" data-idpro="<?= $c['id_produk'] ?>">
                                                <div class="input-group">
                                                    <input type="number" id="<?= $c['id_produk'] ?>" name="qty" value="<?= $c['qty'] ?>" class="form-control" min="1">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary"><i class="fas fa-check"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <div class="subtext<?= $c['id_produk'] ?>">Rp. <?= rupiah($c['subtotal']) ?></div>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('cart/delete/') . $c['id'] ?>" onclick="return confirm('Anda yakin menghapus produk tersebut?')">
                                                <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $no++;
                                endforeach;
                                ?>
                                <tr class="bg bg-primary text-white">
                                    <td colspan='3'><b>Subtotal </b>
                                        <i class='pull-right terbilang'><?= terbilang(array_sum(array_column($cart, 'subtotal'))); ?> Rupiah</i>
                                    </td>
                                    <td>
                                        <span>
                                            <b class="total">Rp. <?= rupiah(array_sum(array_column($cart, 'subtotal'))); ?></b>
                                        </span>
                                    </td>
                                    <td class="bg bg-primary"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="<?= base_url(); ?>" class="btn btn-warning text-white"><i class="fas fa-backward"></i> Kembali Belanja</a>
                <a href="<?= base_url('checkout'); ?>" class="float-right btn btn-success">Pembayaran <i class="fas fa-forward"></i></a>
            </div>
        </div>
    </div>
</div>

<?php
$this->load->view('front/templates/footer');
?>