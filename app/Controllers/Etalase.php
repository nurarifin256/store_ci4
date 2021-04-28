<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;

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

        $modelKomentar = new \App\Models\KomentarModel();
        $komentar = $modelKomentar->where('id_barang', $id)->findAll();
        // dd($komentar);

        $provinsi = $this->rajaongkir('province');
        // dd($provinsi)

        if ($this->request->getPost()) {
            $data = $this->request->getPost();
            $this->validation->run($data, 'transaksi');
            $errors = $this->validation->getErrors();

            if (!$errors) {
                $transaksiModel = new \App\Models\TransaksiModel();
                $transaksi = new \App\Entities\Transaksi();

                $barangModel = new \App\Models\BarangModel();
                $id_barang = $this->request->getPost('id_barang');
                $jumlah_pembelian = $this->request->getPost('jumlah');

                $barang = $barangModel->find($id_barang);
                $entityBarang = new \App\Entities\Barang();

                $entityBarang->id = $id_barang;

                $entityBarang->stok = $barang->stok - $jumlah_pembelian;
                $barangModel->save($entityBarang);


                $transaksi->fill($data);
                $transaksi->status = 0;
                $transaksi->created_by = $this->session->get('id');
                $transaksi->created_date = date("Y-m-d H:i:s");

                $transaksiModel->save($transaksi);

                $id = $transaksiModel->insertID();
                // dd($id);
                return redirect()->to('/Transaksi/index/' . $id);
            }
        }


        return view('etalase/beli', [
            'model' => $model,
            'komentar' => $komentar,
            'provinsi' => json_decode($provinsi)->rajaongkir->results,
        ]);
    }

    public function getCity()
    {
        if ($this->request->isAJAX()) {
            $id_province = $this->request->getGet('id_province');
            $data = $this->rajaongkir('city', $id_province);
            return $this->response->setJSON($data);
        }
    }

    public function getCost()
    {
        if ($this->request->isAJAX()) {
            $origin = $this->request->getGet('origin');
            $destination = $this->request->getGet('destination');
            $weight = $this->request->getGet('weight');
            $courier = $this->request->getGet('courier');

            $data = $this->rajaongkircost($origin, $destination, $weight, $courier);
            return $this->response->setJSON($data);
        }
    }

    private function rajaongkircost($origin, $destination, $weigth, $courier)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weigth . "&courier=" . $courier,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key:" . $this->apikey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response;
    }

    private function rajaongkir($method, $id_province = null)
    {
        $endPoint = $this->url . $method;
        if ($id_province != null) {
            $endPoint = $endPoint . "?province=" . $id_province;
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
                "key: " . $this->apikey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response;
    }
}
