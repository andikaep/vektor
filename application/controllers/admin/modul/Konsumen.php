<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsumen extends CI_Controller
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
        $data['title'] = "Konsumen Menu";
        $data['konsumen'] = $this->global_mod->view('konsumen')->result_array();
        $this->load->view('administrator/konsumen/list', $data);
    }

    public function nonaktif($id)
    {
        $where = ['id' => $id];
        $data = ['is_active' => 0];
        $this->global_mod->update('konsumen', $data, $where);
        $this->session->set_flashdata("message", "<div class='alert alert-info'>Konsumen Berhasil dinonaktifkan</div>");
        redirect('admin/modul/konsumen');
    }
}
