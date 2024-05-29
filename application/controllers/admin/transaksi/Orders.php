<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller
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
        $data['title'] = "Laporan Pesanan Masuk";
        $this->db->select('konsumen.username, penjualan.*');
        $this->db->from('penjualan');
        $this->db->join('konsumen', 'penjualan.id_pembeli = konsumen.id');
        $this->db->order_by('id', 'DESC');
        $data['orders'] = $this->db->get()->result_array();
        $this->load->view('administrator/orders/list', $data);
    }

    public function detail($kode = null)
    {
        if ($kode == null) {
            redirect(base_url('admin/modul/orders'));
        } else {
            $data['title'] = "Detail - " . $kode;
            $this->db->select('konsumen.*, penjualan.*, alamat_pengiriman_konsumen.*, kota.nama_kota');
            $this->db->from('penjualan');
            $this->db->join('konsumen', 'penjualan.id_pembeli = konsumen.id');
            $this->db->join('alamat_pengiriman_konsumen', 'penjualan.id_alamat_pengiriman_konsumen = alamat_pengiriman_konsumen.id');
            $this->db->join('kota', 'kota.id = alamat_pengiriman_konsumen.id');
            $this->db->where('penjualan.kode_transaksi', $kode);
            $data['detail'] = $this->db->get()->row_array();

            $this->db->select('penjualan_detail.*, admin_produk.*');
            $this->db->from('penjualan');
            $this->db->join('penjualan_detail', 'penjualan.id = penjualan_detail.id_penjualan');
            $this->db->join('admin_produk', 'penjualan_detail.id_produk = admin_produk.id');
            $this->db->where('penjualan.kode_transaksi', $kode);
            $data['produk'] = $this->db->get()->result_array();

            $this->db->select('konfirmasi.*, admin_rekening.*');
            $this->db->from('konfirmasi');
            $this->db->join('penjualan', 'penjualan.id = konfirmasi.id_penjualan');
            $this->db->join('admin_rekening', 'konfirmasi.id_rekening = admin_rekening.id');
            $this->db->where('penjualan.kode_transaksi', $kode);
            $data['konfirmasi'] = $this->db->get()->row_array();

            $this->load->view('administrator/orders/detail', $data);
        }
    }


    function orders_status()
    {
        $data = array('proses' => $this->uri->segment(6));
        $where = array('id' => $this->uri->segment(5));
        $this->global_mod->update('penjualan', $data, $where);
        $this->session->set_flashdata("message", "<div class='alert alert-success'>Status Berhasil diubah</div>");
        redirect('admin/transaksi/konfirmasi');
    }
}
