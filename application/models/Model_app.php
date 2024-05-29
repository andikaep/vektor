<?php
class Model_app extends CI_model
{
    public function view($table)
    {
        return $this->db->get($table);
    }

    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function edit($table, $data)
    {
        return $this->db->get_where($table, $data);
    }

    public function update($table, $data, $where)
    {
        return $this->db->update($table, $data, $where);
    }

    public function delete($table, $id)
    {
        return $this->db->delete($table, ['id' => $id]);
    }

    public function view_where($table, $data)
    {
        $this->db->where($data);
        return $this->db->get($table);
    }

    public function view_ordering_limit($table, $order, $ordering, $baris, $dari)
    {
        $this->db->select('*');
        $this->db->order_by($order, $ordering);
        $this->db->limit($dari, $baris);
        return $this->db->get($table);
    }

    public function view_where_ordering_limit($table, $data, $order, $ordering, $baris, $dari)
    {
        $this->db->select('*');
        $this->db->where($data);
        $this->db->order_by($order, $ordering);
        $this->db->limit($dari, $baris);
        return $this->db->get($table);
    }

    public function view_ordering($table, $order, $ordering)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($order, $ordering);
        return $this->db->get()->result_array();
    }

    public function view_where_ordering($table, $data, $order, $ordering)
    {
        $this->db->where($data);
        $this->db->order_by($order, $ordering);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function view_join_one($table1, $table2, $field, $order, $ordering)
    {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1 . '.' . $field . '=' . $table2 . '.' . $field);
        $this->db->order_by($order, $ordering);
        return $this->db->get()->result_array();
    }

    public function view_join_where($table1, $table2, $field, $where, $order, $ordering)
    {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1 . '.' . $field . '=' . $table2 . '.' . $field);
        $this->db->where($where);
        $this->db->order_by($order, $ordering);
        return $this->db->get()->result_array();
    }

    public function view_join_rows($table1, $table2, $field, $where, $order, $ordering)
    {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1 . '.' . $field . '=' . $table2 . '.' . $field);
        $this->db->where($where);
        $this->db->order_by($order, $ordering);
        return $this->db->get();
    }

    public function view_join_where_one($table1, $table2, $field, $where)
    {
        $this->db->select('*');
        $this->db->from($table1);
        $this->db->join($table2, $table1 . '.' . $field . '=' . $table2 . '.' . $field);
        $this->db->where($where);
        return $this->db->get();
    }

    function cari_produk($kata)
    {
        $pisah_kata = explode(" ", $kata);
        $jml_katakan = (int) count($pisah_kata);
        $jml_kata = $jml_katakan - 1;
        $cari = "SELECT * FROM admin_produk WHERE ";
        for ($i = 0; $i <= $jml_kata; $i++) {
            $cari .= " nama_produk LIKE '%" . $pisah_kata[$i] . "%'";
            if ($i < $jml_kata) {
                $cari .= " OR ";
            }
        }
        $cari .= " ORDER BY id DESC LIMIT 12";
        return $this->db->query($cari);
    }


    function grafik_kunjungan()
    {
        return $this->db->query("SELECT count(*) as jumlah, tanggal FROM statistik GROUP BY tanggal ORDER BY tanggal DESC LIMIT 10");
    }

    function orders_report($id)
    {
        return $this->db->query("SELECT * FROM `penjualan` a where a.id_pembeli='$id' ORDER BY a.id_penjualan DESC");
    }


    function orders_report_all()
    {
        return $this->db->query("SELECT * FROM `penjualan` ORDER BY id DESC");
    }

    function orders_report_home($limit)
    {
        return $this->db->query("SELECT * FROM `penjualan` a ORDER BY a.id_penjualan DESC LIMIT $limit");
    }

    function best_seller()
    {
        $query = "SELECT ap.nama_produk, ap.seo_produk, ap.harga_jual, ap.gambar, count(pd.id_produk) as urutan
                    FROM penjualan_detail as pd, admin_produk as ap
                    WHERE pd.id_produk = ap.id
                    GROUP by id_produk order by urutan DESC LIMIT 3";
        return $this->db->query($query)->result_array();
    }

    function konfirmasi_bayar()
    {
        return $this->db->query("SELECT b.kode_transaksi, b.proses, b.id as id_penjual, a.*, c.* FROM `konfirmasi` a JOIN penjualan b ON a.id_penjualan=b.id JOIN admin_rekening c ON a.id_rekening=c.id ORDER BY a.id DESC");
    }

    function kunjungan()
    {
        $ip      = $_SERVER['REMOTE_ADDR'];
        $tanggal = date("Y-m-d");
        $waktu   = time();
        $cekk = $this->db->query("SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
        $rowh = $cekk->row_array();
        if ($cekk->num_rows() == 0) {
            $datadb = array('ip' => $ip, 'tanggal' => $tanggal, 'hits' => '1', 'online' => $waktu);
            $this->db->insert('statistik', $datadb);
        } else {
            $hitss = $rowh['hits'] + 1;
            $datadb = array('ip' => $ip, 'tanggal' => $tanggal, 'hits' => $hitss, 'online' => $waktu);
            $array = array('ip' => $ip, 'tanggal' => $tanggal);
            $this->db->where($array);
            $this->db->update('statistik', $datadb);
        }
    }

    function tracking($kode_transaksi)
    {
        $total = $this->db->query(
            "SELECT a.kode_transaksi, a.kurir, a.service, a.ongkir, a.waktu_transaksi, a.proses, 
            b.qty as jumlah, 
            c.nama_produk, c.seo_produk, c.harga_beli, c.harga_jual, c.harga_reseller, c.stok, c.diskon, c.berat, c.gambar, c.keterangan, 
            d.username, d.nama_lengkap, d.email, d.no_telp, d.alamat_lengkap,
            e.nama_kota, f.nama_provinsi, 
            sum((c.harga_jual*b.qty)-(c.diskon*b.qty)) as total, sum(c.berat*b.qty) as total_berat, 
            g.total_transfer, g.nama_pengirim, g.bukti_transfer, g.waktu_konfirmasi, g.id_rekening 
            FROM `penjualan` a 
            JOIN penjualan_detail b ON a.id=b.id_penjualan 
            JOIN admin_produk c ON b.id_produk=c.id 
            JOIN konsumen d ON a.id_pembeli=d.id 
            JOIN kota e ON d.id_kota=e.id 
            JOIN provinsi f ON e.id_provinsi=f.id 
            JOIN konfirmasi as g ON g.id_penjualan=a.id 
            where a.kode_transaksi='$kode_transaksi'"
        );
        return $total;
    }
}
