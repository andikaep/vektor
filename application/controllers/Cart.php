<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{


    public function index()
    {
        if ($this->session->userdata('username_konsumen') == '') {
            redirect(base_url());
        }
        $data['title'] = title('Cart');
        $this->db->select('admin_produk.nama_produk, admin_produk.gambar, cart.*');
        $this->db->from('cart');
        $this->db->join('admin_produk', 'cart.id_produk = admin_produk.id');
        $this->db->where('cart.id_konsumen = ', $this->session->userdata('id_konsumen'));
        $data['cart'] = $this->db->get()->result_array();
        $this->load->view('front/cart', $data);
    }

    public function add()
    {
        if ($this->session->userdata('username_konsumen') == '') {
            echo json_encode([
                "cart" => false
            ]);
        } else {
            if (!$_POST || $this->input->post('qty', true) <= 0) {
                redirect(base_url());
            } else {
                $input = $this->input->post(null, true);
                $produk = $this->global_mod->view_where("admin_produk", ['id' => $input['id_produk']])->row_array();

                $subtotal = ($produk['harga_jual'] - $produk['diskon']) * $input['qty'];
                $berat = ($produk['berat']) * $input['qty'];

                $cart = $this->global_mod->view_where('cart', ["id_produk" => $input['id_produk'], "id_konsumen" => $this->session->userdata('id_konsumen')])->row_array();

                if ($cart) {
                    $data = [
                        'qty'         => $cart['qty'] + $input['qty'],
                        'subtotal'    => $cart['subtotal'] + $subtotal,
                        'subberat'    => $cart['subberat'] + $berat
                    ];

                    if ($this->global_mod->update("cart", $data, ["id_produk" => $input['id_produk'], "id_konsumen" => $this->session->userdata('id_konsumen')])) {
                        $count['count'] = getCart();
                        echo json_encode([
                            "cart" => true,
                            $data, $count
                        ]);
                    } else {
                        echo json_encode([
                            "hadir" => false,
                        ]);
                    }
                } else {
                    $data = [
                        'id_produk'       => $input['id_produk'],
                        'id_konsumen'     => $this->session->userdata('id_konsumen'),
                        'qty'             => $input['qty'],
                        'subtotal'        => $subtotal,
                        'subberat'        => $berat,
                    ];

                    if ($this->global_mod->insert("cart", $data)) {
                        $count['count'] = getCart();
                        echo json_encode([
                            "cart" => true,
                            $data, $count
                        ]);
                    } else {
                        echo json_encode([
                            "cart" => false,
                        ]);
                    }
                }
            }
        }
    }

    public function update_qty()
    {
        if ($this->session->userdata('username_konsumen') == '') {
            redirect(base_url());
        }
        if (!$_POST || $this->input->post('qty', true) <= 0) {
            redirect(base_url());
        } else {
            $input = $this->input->post(null, true);
            $produk = $this->global_mod->view_where('admin_produk', ['id' => $input['id_produk']])->row_array();
            $subtotal = $input['qty'] * ($produk['harga_jual'] - $produk['diskon']);
            $subberat = $input['qty'] * ($produk['berat']);
            $data = [
                'qty' => $input['qty'],
                'subtotal' => $subtotal,
                'subberat' => $subberat
            ];

            if ($this->global_mod->update("cart", $data, ["id_produk" => $input['id_produk'], "id_konsumen" => $this->session->userdata('id_konsumen')])) {
                $cart = $this->global_mod->view_where('cart', ['id_konsumen' => $this->session->userdata('id_konsumen')])->result_array();

                $data['total'] = array_sum(array_column($cart, 'subtotal'));
                echo json_encode([
                    "cart" => true,
                    $data
                ]);
            } else {
                echo json_encode([
                    "cart" => false,
                ]);
            }
        }
    }

    public function delete($id)
    {
        if ($this->session->userdata('username_konsumen') == '') {
            redirect(base_url());
        }
        if ($id) {
            $this->global_mod->delete('cart', $id);
            $this->session->set_flashdata(
                'messages',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> Produk telah dihapus.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
            );
            redirect('cart');
        }
    }
}

/* End of file Cart.php */
