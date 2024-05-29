<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kurir_model');
        $username = $this->session->userdata('username_konsumen');
        if (!$username) {
            redirect('produk');
        }
    }

    public function add()
    {
        // Security Cek Ongkir
        // $cek_layanan = $this->Kurir_model->cek_service($kurir, $id_kota, $berat, $layanan);
        // var_dump($cek_layanan);
        // die;

        if (!$_POST) {
            redirect(base_url('cart'));
        } else {
            $input = $this->input->post(null, true);
            $berat = $this->db->select_sum('subberat')
                ->where('id_konsumen', $this->session->userdata('id_konsumen'))
                ->get('cart')
                ->row_array();
            $total = $this->db->select_sum('subtotal')
                ->where('id_konsumen', $this->session->userdata('id_konsumen'))
                ->get('cart')
                ->row_array();
            $kota = $this->db->select('id_kota')
                ->where('id', $input['kota_alamat'])
                ->get('alamat_pengiriman_konsumen')
                ->row_array();
            $cek_layanan = $this->Kurir_model->cek_service($input['kurir'], $kota['id_kota'], $berat['subberat'], $input['layanan']);

            if (!$cek_layanan) {
                redirect('checkout');
            }

            $data = [
                'kode_transaksi' => 'TRX-' . date('YmdHis'),
                'id_pembeli' => $this->session->userdata('id_konsumen'),
                'kurir' => $input['kurir'],
                'service' => $cek_layanan,
                'ongkir' => $input['layanan'],
                'total_belanja' => $total['subtotal'],
                'waktu_transaksi' => date('Y-m-d H:i:s'),
                'id_alamat_pengiriman_konsumen' => $input['kota_alamat'],
                'proses' => '0'
            ];

            if ($order = $this->global_mod->insert('penjualan', $data)) {
                $cart = $this->global_mod->view_where('cart', ['id_konsumen' => $this->session->userdata('id_konsumen')])->result_array();
                foreach ($cart as $c) {
                    $c['id_penjualan'] = $order;
                    unset($c['id'], $c['id_konsumen']);
                    $this->global_mod->insert('penjualan_detail', $c);
                }

                $data['title'] = title('Transaksi Sukses');
                $this->db->delete('cart', ['id_konsumen' => $this->session->userdata('id_konsumen')]);
                $data['rekening'] = $this->global_mod->view('admin_rekening')->result_array();
                $this->load->view('front/sukses', $data);
            };
        }
    }

    public function konfirmasi($invoice = null)
    {
        if ($invoice == null) {
            redirect(base_url());
        } else {
            if (!$_POST) {
                $cek = $this->global_mod->view_where('penjualan', ['proses' => '0', 'kode_transaksi' => $invoice])->row_array();
                if (!$cek) {
                    redirect(base_url('konsumen'));
                }
                $data['title'] = title('Konfirmasi ' . $invoice);
                $data['invoice'] = $invoice;
                $data['rekening'] = $this->global_mod->view('admin_rekening')->result_array();
                $this->load->view('front/konfirmasi', $data);
            } else {
                $input = $this->input->post(null, true);
                $penjualan = $this->global_mod->view_where('penjualan', ['kode_transaksi' => $invoice])->row_array();
                $upload_image = $_FILES['image']['name'];
                if (!$upload_image) {
                    $this->session->set_flashdata("message", "<div class='alert alert-success'>Bukti transfer belum dimasukkan...</div>");
                    redirect(base_url('konsumen'));
                } else {
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size']      = '2048';
                    $config['upload_path'] = './uploads/bukti-transfer/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('image')) {
                        $img = $this->upload->data('file_name');
                    } else {
                        echo $this->upload->display_errors();
                    }
                }
                $data = [
                    'id_penjualan' => $penjualan['id'],
                    'total_transfer' => $input['total_transfer'],
                    'id_rekening' => $input['rekening'],
                    'nama_pengirim' => $input['nama_pengirim'],
                    'norek_pengirim' => $input['norek_pengirim'],
                    'bank_pengiriman' => $input['bank_pengirim'],
                    'bukti_transfer' => $img,
                    'waktu_konfirmasi' => date('Y-m-d H:i:s')
                ];
                $update = [
                    'proses' => '1'
                ];

                $this->global_mod->insert('konfirmasi', $data);
                $this->global_mod->update('penjualan', $update, ['kode_transaksi' => $invoice]);
                $this->session->set_flashdata("message", "<div class='alert alert-success'>Terima kasih telah melakukan konfirmasi...</div>");
                redirect('konsumen');
            }
        }
    }

    public function detail($invoice = null)
    {
        if ($invoice == null) {
            redirect(base_url());
        } else {
            $data['title'] = title('Detail ' . $invoice);
            $data['invoice'] = $this->global_mod->view_where('penjualan', ['kode_transaksi' => $invoice])->row_array();
            $data['cart'] = $this->db->select('admin_produk.nama_produk, admin_produk.gambar, admin_produk.diskon, admin_produk.harga_jual, penjualan_detail.subberat, penjualan_detail.qty, penjualan_detail.subtotal')
                ->from('penjualan')
                ->join('penjualan_detail', 'penjualan.id = penjualan_detail.id_penjualan')
                ->join('admin_produk', 'admin_produk.id=penjualan_detail.id_produk')
                ->where('kode_transaksi', $invoice);
            $data['cart'] = $this->db->get()->result_array();
            $data['konfirmasi'] = $this->global_mod->view_where('konfirmasi', ['id_penjualan' => $data['invoice']['id']])->row_array();
            $data['rekening'] = $this->global_mod->view_where('admin_rekening', ['id' => $data['konfirmasi']['id_rekening']])->row_array();
            $this->load->view('front/detail', $data);
        }
    }
}

/* End of file Penjualan.php */
