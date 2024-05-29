<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrator extends CI_Controller
{
    function index()
    {
        if ($this->session->userdata('username')) {
            redirect('administrator/dashboard');
        }
        $data['title'] = "Administrator | Login";
        $data['website'] = $this->db->get('admin_website')->row_array();
        $this->load->view('administrator/login', $data);
    }

    function ceklogin()
    {
        if ($this->session->userdata('username')) {
            redirect('administrator/dashboard');
        }
        $username = htmlspecialchars($this->input->post('username'));
        $password = $this->input->post('password');

        $user = $this->global_mod->edit('admin_users', ['username' => $username])->row_array();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                if ($user['is_active'] != 0) {
                    $data = [
                        "username" => $username
                    ];
                    $this->session->set_userdata($data);
                    redirect('administrator/dashboard');
                } else {
                    $this->session->set_flashdata("message", "<div class='alert alert-danger'>Akun anda telah dinonaktifkan</div>");
                    redirect('administrator');
                }
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger'>Password tidak benar</div>");
                redirect('administrator');
            }
        } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger'>Username tidak ditemukan</div>");
            redirect('administrator');
        }
    }

    function dashboard()
    {
        $data['title'] = "Administrator";
        $this->db->select('konsumen.username, penjualan.*');
        $this->db->from('penjualan');
        $this->db->join('konsumen', 'penjualan.id_pembeli = konsumen.id');
        $this->db->limit(5);
        $this->db->order_by('id', 'DESC');
        $data['orders'] = $this->db->get()->result_array();
        $data['penjualan'] = $this->global_mod->view('penjualan')->result_array();
        $data['penjualan_detail'] = $this->global_mod->view('penjualan_detail')->result_array();
        $this->load->view('templates/content', $data);
    }

    function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->set_flashdata("message", "<div class='alert alert-info'>Anda berhasil logout</div>");
        redirect('administrator');
    }
}
