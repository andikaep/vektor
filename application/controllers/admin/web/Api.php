<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
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
        $data['api'] = $this->global_mod->view('admin_apikey')->row_array();
        $data['title'] = "API Setting";
        $this->load->view('administrator/api/list', $data);
    }

    public function edit($id)
    {
        $data['api'] = $this->global_mod->edit('admin_apikey', ['id' => $id])->row_array();

        $this->form_validation->set_rules('sumber', 'Penyedia', 'required|trim');
        $this->form_validation->set_rules('apikey', 'API Key', 'required|trim');
        $this->form_validation->set_rules('status', 'Paket', 'required|trim');
        if ($this->form_validation->run() == true) {
            $update = [
                "sumber" => $this->db->escape_str($this->input->post('sumber', true)),
                "apikey" => $this->db->escape_str($this->input->post('apikey', true)),
                "status" => $this->db->escape_str($this->input->post('status', true))
            ];
            $where = ['id' => $id];
            $this->global_mod->update('admin_apikey', $update, $where);
            $this->session->set_flashdata("message", "<div class='alert alert-success'>Setting Berhasil diubah</div>");
            redirect('admin/web/api');
        } else {
            $data['title'] = "Form Setting API";
            $this->load->view('administrator/api/form_edit', $data);
        }
    }
}
