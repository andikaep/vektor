<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
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
        $data['kategori'] = $this->global_mod->view('admin_kategori')->result_array();
        $data['title'] = "Kategori";
        $this->load->view('administrator/kategori/list', $data);
    }

    public function add($id = null)
    {
        if (isset($_POST['submit'])) {
            $seo = $this->db->escape_str(strtolower($this->input->post('nama_kategori')));
            $exp = explode(" ", $seo);
            $imp = implode('-', $exp);
            $data = [
                'id_parent' => $this->db->escape_str($this->input->post('id_parent')),
                'nama_kategori' => $this->db->escape_str($this->input->post('nama_kategori')),
                'seo_kategori' => $imp,
                'is_active' => $this->db->escape_str($this->input->post('status'))
            ];
            if ($id == null) {
                $this->global_mod->insert('admin_kategori', $data);
                $this->session->set_flashdata("message", "<div class='alert alert-success'>Kategori Berhasil ditambahkan</div>");
            } else {
                $this->global_mod->update('admin_kategori', $data, ['id' => $id]);
                $this->session->set_flashdata("message", "<div class='alert alert-info'>Kategori Berhasil diubah</div>");
            }
            redirect('admin/modul/kategori');
        } else {
            $data['kategoriutama'] = $this->global_mod->view_where('admin_kategori', ['id_parent' => 0])->result_array();
            if ($id == null) {
                $data['title'] = "Form Tambah Kategori";
                $this->load->view('administrator/kategori/form_add', $data);
            } else {
                $data['title'] = "Form Edit Kategori";
                $data['kategori'] = $this->global_mod->edit('admin_kategori', ['id' => $id])->row_array();
                $this->load->view('administrator/kategori/form_edit', $data);
            }
        }
    }

    public function delete($id)
    {
        $this->global_mod->delete('admin_kategori', $id);
        $this->session->set_flashdata("message", "<div class='alert alert-success'>Data Berhasil dihapus</div>");
        redirect('admin/modul/kategori');
    }
}
