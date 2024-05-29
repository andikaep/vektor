<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsumen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->global_mod->kunjungan();
    }

    public function index()
    {
        $data['title'] = title('Profile');
        $username = $this->session->userdata('username_konsumen');
        if (!$username) {
            redirect('produk');
        }
        $data['profile'] = $this->global_mod->view_where('konsumen', ['username' => $username])->row_array();
        $data['penjualan'] = $this->global_mod->view_where('penjualan', ['id_pembeli' => $data['profile']['id']])->result_array();
        $data['alamat'] = $this->global_mod->view_where('alamat_pengiriman_konsumen', ['id_konsumen' => $data['profile']['id']])->result_array();
        $data['kota'] = $this->global_mod->view('kota')->result_array();
        $this->load->view('front/konsumen', $data);
    }

    function ceklogin()
    {
        $username = htmlspecialchars($this->input->post('username'));
        $password = $this->input->post('password');

        $user = $this->global_mod->view_where('konsumen', ['username' => $username])->row_array();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                if ($user['is_active'] != 0) {
                    $data = [
                        "username_konsumen" => $username,
                        "id_konsumen" => $user['id']
                    ];
                    $this->session->set_userdata($data);
                    echo json_encode([
                        "login" => true
                    ]);
                } else {
                    echo json_encode([
                        "login" => false,
                        "status" => "<div class='alert alert-success'>Akun anda telah dinonaktifkan</div>"
                    ]);
                }
            } else {
                echo json_encode([
                    "login" => false,
                    "status" => "<div class='alert alert-danger'>Username atau password salah</div>"
                ]);
            }
        } else {
            echo json_encode([
                "login" => false,
                "status" => "<div class='alert alert-danger'>Username belum terdaftar</div>"
            ]);
        }
    }

    function registrasi()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[konsumen.username]', [
            'is_unique' => 'Username telah digunakan'
        ]);
        $this->form_validation->set_rules('no_telp', 'No Telephone', 'required|trim');
        $this->form_validation->set_rules('kota', 'Kota', 'required|trim');
        $this->form_validation->set_rules('alamat_pengiriman', 'Alamat Pengiriman', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|matches[konfirmasi_password]', [
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required|trim|min_length[6]|matches[password]', [
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        if ($this->form_validation->run() == true) {
            $data = [
                "username" => $this->db->escape_str($this->input->post('username', true)),
                "no_telp" => $this->db->escape_str($this->input->post('no_telp', true)),
                "password" =>  password_hash($this->db->escape_str($this->input->post('password', true)), PASSWORD_DEFAULT),
                "is_active" => 1,
                "foto" => "user.png",
                "tanggal_daftar" => date('Y-m-d')
            ];
            $this->global_mod->insert('konsumen', $data);
            $userbaru = $this->global_mod->view_where('konsumen', ["username" => $this->db->escape_str($this->input->post('username', true))])->row_array();
            $alamat = [
                "alamat_pengiriman" => $this->db->escape_str($this->input->post('alamat_pengiriman', true)),
                "id_kota" => $this->db->escape_str($this->input->post('kota', true)),
                "id_konsumen" => $userbaru['id'],
                "nama_penerima" => $userbaru['username'],
            ];
            $this->global_mod->insert('alamat_pengiriman_konsumen', $alamat);
            $data = [
                "username_konsumen" => $this->db->escape_str($this->input->post('username', true)),
                "id_konsumen" => $userbaru['id']
            ];
            $this->session->set_userdata($data);
            echo json_encode([
                "registrasi" => true,
                "status" => "<div class='alert alert-success'>Register success, Please Wait, Automatic login</div>"
            ]);
        } else {
            echo json_encode([
                "registrasi" => false,
                "status" => "<div class='alert alert-danger'>Username telah digunakan</div>"
            ]);
        }
    }

    function logout()
    {
        $this->session->unset_userdata('username_konsumen');
        $this->session->unset_userdata('id_konsumen');
        $this->session->unset_userdata('idp');
        redirect('produk');
    }

    function alamat()
    {
        $username = $this->session->userdata('username_konsumen');
        if (!$username) {
            redirect('produk');
        }
        if (!$_POST) {
            redirect(base_url());
        } else {
            $data = [
                "id_konsumen" => $this->session->userdata('id_konsumen'),
                "nama_penerima" => htmlspecialchars($this->input->post('nama', true)),
                "alamat_pengiriman" => htmlspecialchars($this->input->post('alamat', true)),
                "id_kota" => htmlspecialchars($this->input->post('kota_add', true))
            ];

            $insert = $this->global_mod->insert('alamat_pengiriman_konsumen', $data);
            if ($insert) {
                $this->session->set_flashdata("message", "<div class='alert alert-success'>Penerima & Alamat ditambahkan</div>");
                redirect('checkout');
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger'>Gagal ditambahkan</div>");
                redirect('checkout');
            }
        }
    }
}
