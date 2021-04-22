<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;

class Transaksi extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session    = session();
    }

    public function index()
    {
        $id = $this->request->uri->getSegment(3);
        // dd($id);

        $transaksiModel = new \App\Models\TransaksiModel();
        $transaksi = $transaksiModel
            ->join('barang', 'barang.id=transaksi.id_barang')
            ->join('user', 'user.id=transaksi.id_pembeli')
            ->where('transaksi.id', $id)
            ->first();

        dd($transaksi);

        return view('transaksi/index', [
            'transaksi' => $transaksi
        ]);
    }
}
