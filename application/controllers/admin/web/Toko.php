<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Toko extends CI_Controller
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
        $data['toko'] = $this->global_mod->view('admin_toko')->row_array();
        $data['title'] = "Toko Setting";
        $this->load->view('administrator/toko/list', $data);
    }

    public function edit($id)
    {
        $data['toko'] = $this->global_mod->edit('admin_toko', ['id' => $id])->row_array();
        $data['kota'] = $this->global_mod->view('kota')->result_array();

        $this->form_validation->set_rules('pemilik_toko', 'Pemilik Toko', 'required|trim');
        $this->form_validation->set_rules('motto_toko', 'Brand Toko', 'required|trim');
        $this->form_validation->set_rules('no_telp_toko', 'Telphone', 'required|trim');
        $this->form_validation->set_rules('email_toko', 'Email', 'required|trim');
        $this->form_validation->set_rules('alamat_toko', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('wa', 'Whatsapp', 'required|trim');
        $this->form_validation->set_rules('facebook', 'Facebook', 'required|trim');
        $this->form_validation->set_rules('twitter', 'Twitter', 'required|trim');
        $this->form_validation->set_rules('instagram', 'Instagram', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('kota', 'Kota', 'required|trim');
        if ($this->form_validation->run() == true) {
            $update = [
                "pemilik_toko" => $this->db->escape_str($this->input->post('pemilik_toko', true)),
                "motto_toko" => $this->db->escape_str($this->input->post('motto_toko', true)),
                "no_telp_toko" => $this->db->escape_str($this->input->post('no_telp_toko', true)),
                "email_toko" => $this->db->escape_str($this->input->post('email_toko', true)),
                "alamat_toko" => $this->db->escape_str($this->input->post('alamat_toko', true)),
                "wa" => $this->db->escape_str($this->input->post('wa', true)),
                "facebook" => $this->db->escape_str($this->input->post('facebook', true)),
                "twitter" => $this->db->escape_str($this->input->post('twitter', true)),
                "instagram" => $this->db->escape_str($this->input->post('instagram', true)),
                "deskripsi" => $this->db->escape_str($this->input->post('deskripsi', true)),
                "id_kota_toko" => $this->db->escape_str($this->input->post('kota', true))
            ];
            $where = ['id' => $id];
            $this->global_mod->update('admin_toko', $update, $where);
            $this->session->set_flashdata("message", "<div class='alert alert-success'>Setting Berhasil diubah</div>");
            redirect('admin/web/toko');
        } else {
            $data['title'] = "Form Setting Toko";
            $this->load->view('administrator/toko/form_edit', $data);
        }
    }
}
