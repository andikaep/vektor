<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Link extends CI_Controller
{

    public function index($link = null)
    {
        if (!$link) {
            $data['title'] = title('About Us');
            $data['link'] = $this->global_mod->view_where('admin_statis', ['nama_statis' => 'about-us'])->row_array();
        } else {
            $data['title'] = title($link);
            $data['link'] = $this->global_mod->view_where('admin_statis', ['nama_statis' => $link])->row_array();
        }
        $this->load->view('front/link', $data);
    }
}

/* End of file Link.php */
