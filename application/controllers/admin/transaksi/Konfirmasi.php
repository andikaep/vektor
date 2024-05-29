<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konfirmasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('administrator');
        }
    }

    public function index()
    {
        $data['title'] = "Laporan Konfirmasi Pembayaran";
        $data['konfirmasi'] = $this->global_mod->konfirmasi_bayar()->result_array();
        $this->load->view('administrator/konfirmasi/list', $data);
    }

    public function detail($kode_transaksi)
    {
        $data['title'] = "Tracking Order - " . $kode_transaksi;
        $data['detail'] = $this->global_mod->tracking($kode_transaksi)->row_array();
        $data['produk'] = $this->db->query("SELECT a.kode_transaksi, a.ongkir, a.kurir, a.service, b.*, c.nama_produk, c.satuan, c.berat, c.diskon, c.seo_produk, c.harga_jual FROM `penjualan` a JOIN penjualan_detail b ON a.id=b.id_penjualan JOIN admin_produk c ON b.id_produk=c.id where a.kode_transaksi='$kode_transaksi'")->result_array();
        $data['rekening'] = $this->global_mod->view_where('admin_rekening', ['id' => $data['detail']['id_rekening']])->row_array();
        $this->load->view('administrator/konfirmasi/detail', $data);
    }
}
