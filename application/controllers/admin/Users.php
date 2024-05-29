<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
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
        $data['title'] = "Admin Menu";
        $data['users'] = $this->global_mod->view('admin_users')->result_array();
        $this->load->view('administrator/users/list', $data);
    }

    public function add($id = null)
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        if ($id == null) {
            $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[admin_users.username]');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[password_konfirmasi]', [
                'matches' => 'Password tidak sama!',
                'min_length' => 'Password terlalu pendek!'
            ]);
            $this->form_validation->set_rules('password_konfirmasi', 'Password', 'matches[password]', [
                'matches' => 'Password tidak sama!'
            ]);
        } else {
            $this->form_validation->set_rules('password', 'Password', 'matches[password_konfirmasi]', [
                'matches' => 'Password tidak sama!',
                'min_length' => 'Password terlalu pendek!'
            ]);
            $this->form_validation->set_rules('password_konfirmasi', 'Password', 'matches[password]', [
                'matches' => 'Password tidak sama!'
            ]);
        }
        $this->form_validation->set_rules('no_telp', 'No Telephone', 'required|trim');
        $this->form_validation->set_rules('level', 'Level', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        if ($this->form_validation->run() == true) {
            $data = [
                "username" => $this->db->escape_str($this->input->post('username', true)),
                "nama_lengkap" => $this->db->escape_str($this->input->post('nama_lengkap', true)),
                "email" => $this->db->escape_str($this->input->post('email', true)),
                "no_telp" => $this->db->escape_str($this->input->post('no_telp', true)),
                "is_active" => $this->db->escape_str($this->input->post('status', true)),
                "level" => $this->db->escape_str($this->input->post('level', true))
            ];
            $upload_image = $_FILES['image']['name'];
            if ($upload_image == null && $id == null) {
                $data["foto"] = "user.png";
            } else {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = './uploads/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $data["foto"] = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $passwd = $this->input->post('password');
            if ($id == null) {
                $data["password"] = password_hash($passwd, PASSWORD_DEFAULT);
                $this->global_mod->insert('admin_users', $data);
                $this->session->set_flashdata("message", "<div class='alert alert-success'>User Berhasil ditambahkan</div>");
                redirect('admin/users');
            } else {
                if ($passwd != null) {
                    $data["password"] = password_hash($passwd, PASSWORD_DEFAULT);
                }
                $where = ['id' => $id, 'username' => $data['username']];
                $this->global_mod->update('admin_users', $data, $where);
                $this->session->set_flashdata("message", "<div class='alert alert-success'>Data Berhasil diubah</div>");
                redirect('admin/users');
            }
        } else {
            if ($id == null) {
                $data['title'] = "Form Tambah User";
                $this->load->view('administrator/users/form_add', $data);
            } else {
                $data['title'] = "Form Edit User";
                $data['user'] = $this->global_mod->edit('admin_users', ['id' => $id])->row_array();
                $this->load->view('administrator/users/form_edit', $data);
            }
        }
    }

    public function detail($id)
    {
        $data['users'] = $this->global_mod->view_where('admin_users', ['id' => $id])->row_array();
        $data['title'] = "Detail - " . $data['users']['nama_lengkap'];
        $this->load->view('administrator/users/detail', $data);
    }

    public function delete($id)
    {
        $this->global_mod->delete('admin_users', $id);
        $this->session->set_flashdata("message", "<div class='alert alert-success'>Data Berhasil dihapus</div>");
        redirect('admin/users');
    }
}
