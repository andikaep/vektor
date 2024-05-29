<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
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
        $data['produk'] = $this->global_mod->view('admin_produk')->result_array();
        $data['title'] = "Produk";
        $this->load->view('administrator/produk/list', $data);
    }

    public function add($id = null)
    {
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|trim|max_length[25]');
            $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');
            $this->form_validation->set_rules('satuan', 'Satuan Produk', 'required|trim');
            $this->form_validation->set_rules('harga_beli', 'Harga Beli', 'required|trim');
            $this->form_validation->set_rules('harga_reseller', 'Harga Reseller', 'required|trim');
            $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required|trim');
            $this->form_validation->set_rules('stok', 'Stok', 'required|trim');
            $this->form_validation->set_rules('diskon', 'diskon', 'required|trim');
            $this->form_validation->set_rules('berat', 'Berat', 'required|trim');
            $seo = $this->db->escape_str(strtolower($this->input->post('nama_produk')));
            $exp = explode(" ", $seo);
            $imp = implode('-', $exp);
            $data = [
                'id_kategori' => $this->db->escape_str($this->input->post('kategori')),
                'nama_produk' => $this->db->escape_str($this->input->post('nama_produk')),
                'seo_produk' => $imp,
                'satuan' => $this->db->escape_str($this->input->post('satuan')),
                'harga_beli' => $this->db->escape_str($this->input->post('harga_beli')),
                'harga_reseller' => $this->db->escape_str($this->input->post('harga_reseller')),
                'harga_jual' => $this->db->escape_str($this->input->post('harga_jual')),
                'stok' => $this->db->escape_str($this->input->post('stok')),
                'diskon' => $this->db->escape_str($this->input->post('diskon')),
                'berat' => $this->db->escape_str($this->input->post('berat')),
                'keterangan' => $this->db->escape_str($this->input->post('keterangan')),
                'id_users' => 1,
                'waktu_input' => date('Y-m-d H:i:s')
            ];
            $upload_image = $_FILES['image']['name'];
            if ($upload_image == null && $id == null) {
                $data["foto"] = "noimage.png";
            } else {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '2048';
                $config['upload_path'] = './uploads/produk/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $data["gambar"] = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            }
            if ($id == null) {
                $this->global_mod->insert('admin_produk', $data);
                $this->session->set_flashdata("message", "<div class='alert alert-success'>produk Berhasil ditambahkan</div>");
            } else {
                $this->global_mod->update('admin_produk', $data, ['id' => $id]);
                $this->session->set_flashdata("message", "<div class='alert alert-info'>produk Berhasil diubah</div>");
            }
            redirect('admin/modul/produk');
        } else {
            $data['kategori'] = $this->global_mod->view_where('admin_kategori', ['is_active' => 1])->result_array();
            if ($id == null) {
                $data['title'] = "Form Tambah Produk";
                $this->load->view('administrator/produk/form_add', $data);
            } else {
                $data['title'] = "Form Edit Produk";
                $data['produk'] = $this->global_mod->edit('admin_produk', ['id' => $id])->row_array();
                $this->load->view('administrator/produk/form_edit', $data);
            }
        }
    }

    public function detail($id)
    {
        $data['produk'] = $this->global_mod->view_where('admin_produk', ['id' => $id])->row_array();
        $data['title'] = "Detail - Produk " . $data['produk']['nama_produk'];
        $this->load->view('administrator/produk/detail', $data);
    }

    public function delete($id)
    {
        $this->global_mod->delete('admin_produk', $id);
        $this->session->set_flashdata("message", "<div class='alert alert-success'>Data Berhasil dihapus</div>");
        redirect('admin/modul/produk');
    }
}
