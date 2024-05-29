<?php
defined('BASEPATH') or exit('No direct script access allowed');

class rekening extends CI_Controller
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
        $data['rekening'] = $this->global_mod->view('admin_rekening')->result_array();
        $data['title'] = "Rekening Menu";
        $this->load->view('administrator/rekening/list', $data);
    }

    public function add($id = null)
    {
        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');
        $this->form_validation->set_rules('no_rekening', 'Nomor Rekening', 'required|trim');
        $this->form_validation->set_rules('pemilik_rekening', 'Pemilik Rekening', 'required|trim');
        if ($this->form_validation->run() == true) {
            $data = [
                "nama_bank" => $this->db->escape_str($this->input->post('nama_bank', true)),
                "no_rekening" => $this->db->escape_str($this->input->post('no_rekening', true)),
                "pemilik_rekening" => $this->db->escape_str($this->input->post('pemilik_rekening', true))
            ];
            if ($id == null) {
                $this->global_mod->insert('admin_rekening', $data);
                $this->session->set_flashdata("message", "<div class='alert alert-success'>Rekening Berhasil ditambahkan</div>");
            } else {
                $where = ['id' => $id];
                $this->global_mod->update('admin_rekening', $data, $where);
                $this->session->set_flashdata("message", "<div class='alert alert-success'>Data Berhasil diubah</div>");
            }
            redirect('admin/web/rekening');
        } else {
            if ($id == null) {
                $data['title'] = "Form Tambah Rekening";
                $this->load->view('administrator/rekening/form_add', $data);
            } else {
                $data['title'] = "Form Edit Rekening";
                $data['rekening'] = $this->global_mod->edit('admin_rekening', ['id' => $id])->row_array();
                $this->load->view('administrator/rekening/form_edit', $data);
            }
        }
    }

    public function delete($id)
    {
        $this->global_mod->delete('admin_rekening', $id);
        $this->session->set_flashdata("message", "<div class='alert alert-success'>Data Berhasil dihapus</div>");
        redirect('admin/web/rekening');
    }
}
