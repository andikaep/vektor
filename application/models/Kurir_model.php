<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kurir_model extends CI_Model
{
    function get_service($kurir, $kota, $berat)
    {
        $owner = $this->global_mod->view('admin_toko')->row_array();
        $apikey = $this->global_mod->view('admin_apikey')->row_array();
        $kota_owner = $owner['id_kota_toko'];
        $apikey_get = $apikey['apikey'];
        $status = $apikey['status'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/$status/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$kota_owner&destination=$kota&weight=$berat&courier=$kurir",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: $apikey_get"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $ongkir = json_decode($response, true);
        }
        $dataharga =  $ongkir['rajaongkir']['results'][0]['costs'];
        $layanan = "<option value='0'>-- PILIH --</option>";
        for ($i = 0; $i < count($dataharga); $i++) {
            foreach ($dataharga[$i]['cost'] as $dh) {
                $layanan .= "<option value='$dh[value]'>" . $ongkir['rajaongkir']['results'][0]['costs'][$i]['service'] . " - Rp. $dh[value]</option>";
            }
        }
        return $layanan;
    }

    function cek_service($kurir, $kota, $berat, $layanan)
    {
        $owner = $this->global_mod->view('admin_toko')->row_array();
        $apikey = $this->global_mod->view('admin_apikey')->row_array();
        $kota_owner = $owner['id_kota_toko'];
        $apikey_get = $apikey['apikey'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$kota_owner&destination=$kota&weight=$berat&courier=$kurir",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: $apikey_get"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $ongkir = json_decode($response, true);
        }
        $dataharga =  $ongkir['rajaongkir']['results'][0]['costs'];
        for ($i = 0; $i < count($dataharga); $i++) {
            foreach ($dataharga[$i]['cost'] as $dh) {
                if ($dh['value'] == (int) $layanan) {
                    $hasil = $dataharga[$i]['service'];
                    break 2;
                } else {
                    $hasil = false;
                }
            }
        }
        return $hasil;
    }
}

/* End of file Kurir_model.php */
