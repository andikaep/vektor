<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $username = $this->session->userdata('username_konsumen');
        if (!$username) {
            redirect('produk');
        }
    }

    function index()
    {
        $this->db->select('admin_produk.nama_produk, admin_produk.harga_jual,  admin_produk.diskon, cart.*');
        $this->db->from('cart');
        $this->db->join('admin_produk', 'cart.id_produk = admin_produk.id');
        $this->db->where('cart.id_konsumen = ', $this->session->userdata('id_konsumen'));
        $data['cart'] = $this->db->get()->result_array();
        if ($data['cart'] != null) {
            $data['title'] = title('Checkout');
            $data['alamat_pengiriman_konsumen'] = $this->global_mod->view_where('alamat_pengiriman_konsumen', ['id_konsumen' => $this->session->userdata('id_konsumen')])->result_array();
            $data['kota'] = $this->global_mod->view('kota')->result_array();
            $this->load->view('front/checkout', $data);
        } else {
            redirect('cart');
        }
    }
}
