<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Banner extends CI_Controller
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
        $data['banners'] = $this->global_mod->view('admin_banner')->result_array();
        $data['title'] = "Banner Setting";
        $this->load->view('administrator/banner/list', $data);
    }

    function sort()
    {
        $bannerID = $this->uri->segment(5);
        $sort = $this->uri->segment(6);
        $penggantiBanner = $this->global_mod->edit('admin_banner', ['id' => $bannerID])->row_array();
        $gantiBanner = $this->global_mod->edit('admin_banner', ['urutan_banner' => $sort])->row_array();
       
        /// Proses Ganti Banner
        $where = ['id' => $bannerID];
        $data['urutan_banner'] = $sort;
        $this->global_mod->update('admin_banner', $data, $where);
        
        //Proses Tukar Nilai Banner
        $whereTuker = ['id' => $gantiBanner['id']];
        $dataTuker['urutan_banner'] = $penggantiBanner['urutan_banner'];
        
        $this->global_mod->update('admin_banner', $dataTuker, $whereTuker);
        redirect('admin/web/banner');
    }

    public function add($id = null)
    {
        $datanow['banners'] = $this->global_mod->view('admin_banner')->result_array();
        $data['banner'] = $this->global_mod->edit('admin_banner', ['id' => $id])->row_array();

        $this->form_validation->set_rules('judul_banner', 'Judul banner', 'required|trim');
        $this->form_validation->set_rules('keterangan_banner', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('link_banner', 'Link', 'required|trim');
        if ($this->form_validation->run() == true) {
            $update = [
                "judul_banner" => $this->db->escape_str($this->input->post('judul_banner', true)),
                "keterangan_banner" => $this->db->escape_str($this->input->post('keterangan_banner', true)),
                "link_banner" => $this->db->escape_str($this->input->post('link_banner', true))
            ];
            $upload_image = $_FILES['image']['name'];
            if ($upload_image != null) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = './uploads/banner/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    unlink(FCPATH . '/uploads/' . $data['banner']['gambar_banner']);
                    $update["gambar_banner"] = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            }
            if ($id == null) {
                $update['urutan_banner'] = count($datanow) + 1;
                $this->global_mod->insert('admin_banner', $update);
                $this->session->set_flashdata("message", "<div class='alert alert-success'>Banner Berhasil ditambahkan</div>");
            } else {
                $where = ['id' => $id];
                $this->global_mod->update('admin_banner', $update, $where);
                $this->session->set_flashdata("message", "<div class='alert alert-success'>Banner Berhasil diubah</div>");
            }
            redirect('admin/web/banner');
        } else {
            if ($id == null) {
                $data['title'] = "Form Tambah Banner";
                $this->load->view('administrator/banner/form_add', $data);
            } else {
                $data['title'] = "Form Setting Banner";
                $this->load->view('administrator/banner/form_edit', $data);
            }
        }
    }
    public function delete($id)
    {
        $this->global_mod->delete('admin_banner', $id);
        $this->session->set_flashdata("message", "<div class='alert alert-success'>Banner Berhasil dihapus</div>");
        redirect('admin/web/banner');
    }
}
