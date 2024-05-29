<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Kurir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kurir_model');
        
    }


    public function index()
    {
        redirect();
    }

    function ambil_data()
    {
        if (!$_POST) {
            redirect('cart');
        }
        $id = $this->input->post('kota', true);
        $berat = $this->global_mod->view_where('cart', ['id_konsumen' => $this->session->userdata('id_konsumen')])->result_array();
        $totalberat = array_sum(array_column($berat, 'subberat'));
        $kurir = $this->input->post('kurir', true);
        $kota = $this->db->select('id_kota')
            ->where('id', $id)
            ->get('alamat_pengiriman_konsumen')
            ->row_array();
        echo $this->Kurir_model->get_service($kurir, $kota['id_kota'], $totalberat);
    }
}

/* End of file Kurir.php */
