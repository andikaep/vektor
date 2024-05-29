<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model');
        if (!$this->session->userdata('username')) {
            redirect('administrator');
        }
    }

    public function index()
    {
        $data['menuadmin'] = $this->menu_model->getData();
        $data['title'] = "Admin Menu";
        $this->load->view('administrator/menu/list', $data);
    }

    public function add()
    {
        if (isset($_POST['submit'])) {
            $data = [
                'id_parent' => $this->db->escape_str($this->input->post('id_parent')),
                'nama_menu' => $this->db->escape_str($this->input->post('nama_menu')),
                'link_menu' => $this->db->escape_str($this->input->post('link_menu')),
                'icon_menu' => $this->db->escape_str($this->input->post('icon_menu'))
            ];
            $this->global_mod->insert('admin_menu', $data);
            $this->session->set_flashdata("message", "<div class='alert alert-success'>Data Berhasil ditambahkan</div>");
            redirect('admin/menu');
        } else {
            $data['title'] = "Form Tambah Menu";
            $data['menuutama'] = $this->menu_model->selectMenu();
            $this->load->view('administrator/menu/form_add', $data);
        }
    }

    public function edit($id)
    {
        if (isset($_POST['submit'])) {
            $data = [
                'id_parent' => $this->db->escape_str($this->input->post('id_parent')),
                'nama_menu' => $this->db->escape_str($this->input->post('nama_menu')),
                'link_menu' => $this->db->escape_str($this->input->post('link_menu')),
                'icon_menu' => $this->db->escape_str($this->input->post('icon_menu'))
            ];
            $where = ['id' => $id];
            $this->global_mod->update('admin_menu', $data, $where);
            $this->session->set_flashdata("message", "<div class='alert alert-success'>Data Berhasil diubah</div>");
            redirect('admin/menu');
        } else {
            $data['title'] = "Form Edit Menu";
            $data['menuutama'] = $this->menu_model->selectMenu();
            $data['editmenu'] = $this->menu_model->getDatabyId($id)->row_array();
            $this->load->view('administrator/menu/form_edit', $data);
        }
    }

    public function delete($id)
    {
        $this->menu_model->deleteData($id);
        $this->session->set_flashdata("message", "<div class='alert alert-success'>Data Berhasil dihapus</div>");
        redirect('admin/menu');
    }
}
