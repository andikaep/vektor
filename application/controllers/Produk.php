<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->global_mod->kunjungan();
    }

    function index()
    {
        $jumlah = $this->global_mod->view('admin_produk')->num_rows();
        $config['base_url'] = base_url() . 'produk/index/';
        $config['total_rows'] = $jumlah;
        $config['per_page'] = 9;

        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';

        $config['first_link']       = 'First';
        $config['first_tag_open']   = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link']        = 'Last';
        $config['last_tag_open']    = '<li class="page-item">';
        $config['last_tag_close']  = '</li>';

        $config['next_link']        = '&raquo';
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tag_close']  = '</li>';

        $config['prev_link']        = '&laquo';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']  = '</li>';

        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';

        $config['cur_tag_open']     = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></a></li>';

        $config['attributes'] = ['class' => 'page-link'];

        if ($this->uri->segment('3') == '') {
            $dari = 0;
        } else {
            $dari = $this->uri->segment('3');
        }
        $data['title'] = title();

        if (is_numeric($dari)) {
            if ($this->input->post('cari') != '') {
                $data['judul'] = "Hasil Pencarian Produk - " . filter($this->input->post('cari'));
                $data['produk'] = $this->global_mod->cari_produk(filter($this->input->post('cari')))->result_array();
            } else {
                $data['produk'] = $this->global_mod->view_ordering_limit('admin_produk', 'id', 'DESC', $dari, $config['per_page'])->result_array();
                $this->pagination->initialize($config);
            }
            $this->load->view('front/home', $data);
        } else if ($dari == 'checkout') {
            redirect('checkout');
        } else {
            redirect('product');
        }
    }

    function detail($produk = null)
    {
        $data['title'] = title("Detail Produk");
        if ($produk == null) {
            redirect(base_url());
        } else {
            $data['produk'] = $this->global_mod->view_where('admin_produk', ['seo_produk' => $produk])->row_array();
            if (!$data['produk']) {
                redirect(base_url());
            }
            $this->load->view('front/detail_produk', $data);
        }
    }

    function kategori($kategori = null)
    {
        if ($kategori == null) {
            redirect(base_url());
        } else {
            $data['kategori'] = $this->global_mod->view_where('admin_kategori', ['seo_kategori' => $kategori])->row_array();
            if (!$data['kategori']) {
                redirect(base_url());
            }
            $data['produk'] = $this->global_mod->view_where('admin_produk', ['id_kategori' => $data['kategori']['id']])->result_array();

            $jumlah = $this->global_mod->view_where('admin_produk', ['id_kategori' => $data['kategori']['id']])->num_rows();
            $config['base_url'] = base_url() . 'produk/kategori/' . $kategori . "/";
            $config['total_rows'] = $jumlah;
            $config['per_page'] = 9;

            $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $config['full_tag_close']   = '</ul></nav></div>';

            $config['first_link']       = 'First';
            $config['first_tag_open']   = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';

            $config['last_link']        = 'Last';
            $config['last_tag_open']    = '<li class="page-item">';
            $config['last_tag_close']  = '</li>';

            $config['next_link']        = '&raquo';
            $config['next_tag_open']    = '<li class="page-item">';
            $config['next_tag_close']  = '</li>';

            $config['prev_link']        = '&laquo';
            $config['prev_tag_open']    = '<li class="page-item">';
            $config['prev_tag_close']  = '</li>';

            $config['num_tag_open']     = '<li class="page-item">';
            $config['num_tag_close']    = '</li>';

            $config['cur_tag_open']     = '<li class="page-item active"><a class="page-link">';
            $config['cur_tag_close']    = '<span class="sr-only">(current)</span></a></li>';

            $config['attributes'] = ['class' => 'page-link'];

            if ($this->uri->segment('4') == '') {
                $dari = 0;
            } else {
                $dari = $this->uri->segment('4');
            }
            $data['title'] = title();

            if (is_numeric($dari)) {
                if ($this->input->post('cari') != '') {
                    $data['judul'] = "Hasil Pencarian Produk - " . filter($this->input->post('cari'));
                    $data['record'] = $this->global_mod->cari_produk(filter($this->input->post('cari')));
                } else {
                    $data['produk'] = $this->global_mod->view_where_ordering_limit('admin_produk', ['id_kategori' => $data['kategori']['id']], 'id', 'DESC', $dari, $config['per_page'])->result_array();
                    $this->pagination->initialize($config);
                }
                $this->load->view('front/detail_kategori', $data);
            } else {
                redirect('product');
            }
        }
    }
}
