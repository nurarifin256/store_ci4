<?php

namespace App\Controllers;

class Etalase extends BaseController
{
    private $url = "https://api.rajaongkir.com/starter/";
    private $apikey = "e03696b1f0bf6f932f172513726544b4";
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session    = session();
    }

    public function index()
    {
        $barang = new \App\Models\BarangModel();
        $model  = $barang->findAll();

        return view('etalase/index.php', [
            'model' => $model
        ]);
    }

    public function beli()
    {
        $id = $this->request->uri->getSegment(3);

        $modelBarang = new \App\Models\BarangModel();
        $model       = $modelBarang->find($id);

        $provinsi = $this->rajaongkir('province');
        // dd($provinsi)
        // menit 56

        return view('etalase/beli', [
            'model' => $model,
            'provinsi' => json_decode($provinsi)->rajaongkir->results
        ]);
    }



    private function rajaongkir($method, $id_province = null)
    {
        $endPoint = $this->url.$method;
        if ($id_province != null) {
            $endPoint = $endPoint."province=".$id_province;
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: ".$this->apikey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response;
    }
}
