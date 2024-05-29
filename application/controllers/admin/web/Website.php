<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Website extends CI_Controller
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
        $data['web'] = $this->global_mod->view('admin_website')->row_array();
        $data['title'] = "Website Setting";
        $this->load->view('administrator/website/list', $data);
    }

    public function edit($id)
    {
        $data['website'] = $this->global_mod->edit('admin_website', ['id' => $id])->row_array();

        $this->form_validation->set_rules('nama_website', 'Nama Website', 'required|trim');
        $this->form_validation->set_rules('nama_website_singkat', 'Nama Singkatan', 'required|trim');
        $this->form_validation->set_rules('footer_website', 'Footer Website', 'required|trim');
        if ($this->form_validation->run() == true) {
            $update = [
                "nama_website" => $this->db->escape_str($this->input->post('nama_website', true)),
                "nama_website_singkat" => $this->db->escape_str($this->input->post('nama_website_singkat', true)),
                "footer_website" => $this->db->escape_str($this->input->post('footer_website', true))
            ];
            $upload_image = $_FILES['image']['name'];
            if ($upload_image != null) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = './uploads/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    unlink(FCPATH . '/uploads/' . $data['website']['logo_website']);
                    $update["logo_website"] = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $where = ['id' => $id];
            $this->global_mod->update('admin_website', $update, $where);
            $this->session->set_flashdata("message", "<div class='alert alert-success'>Setting Berhasil diubah</div>");
            redirect('admin/web/website');
        } else {
            $data['title'] = "Form Setting Website";
            $this->load->view('administrator/website/form_edit', $data);
        }
    }
}
