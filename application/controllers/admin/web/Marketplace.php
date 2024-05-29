<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Marketplace extends CI_Controller
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
        $data['brands'] = $this->global_mod->view('admin_brands')->result_array();
        $data['title'] = "Marketplace Setting";
        $this->load->view('administrator/brands/list', $data);
    }

    public function edit($id)
    {
        $data['brands'] = $this->global_mod->edit('admin_brands', ['id' => $id])->row_array();

        $this->form_validation->set_rules('link', 'Link', 'required|trim');
        if ($this->form_validation->run() == true) {
            $update = [
                "link" => $this->db->escape_str($this->input->post('link', true)),
            ];
            $where = ['id' => $id];
            $this->global_mod->update('admin_brands', $update, $where);
            $this->session->set_flashdata("message", "<div class='alert alert-success'>Setting Berhasil diubah</div>");
            redirect('admin/web/marketplace');
        } else {
            $data['title'] = "Form Setting Marketplace";
            $this->load->view('administrator/brands/form_edit', $data);
        }
    }
}
