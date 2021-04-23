<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use TCPDF;

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
            ->select('*, transaksi.id AS id_trans')
            ->join('barang', 'barang.id=transaksi.id_barang')
            ->join('user', 'user.id=transaksi.id_pembeli')
            ->where('transaksi.id', $id)
            ->first();


        // dd($transaksi);

        return view('transaksi/index', [
            'transaksi' => $transaksi
        ]);
    }

    public function view()
    {
        $transaksiModel = new \App\Models\TransaksiModel();
        $model = $transaksiModel->findAll();

        return view('transaksi/view', [
            'model' => $model
        ]);
    }

    public function invoice()
    {
        $id = $this->request->uri->getSegment(3);

        $transaksiModel = new \App\Models\TransaksiModel();
        $transaksi = $transaksiModel->find($id);

        $userModel = new \App\Models\UserModel();
        $pembeli = $userModel->find($transaksi->id_pembeli);

        $barangModel = new \App\Models\BarangModel();
        $barang = $barangModel->find($transaksi->id_barang);

        $html = view('transaksi/invoice', [
            'transaksi' => $transaksi,
            'pembeli'   => $pembeli,
            'barang'    => $barang
        ]);

        $pdf = new TCPDF('L', PDF_UNIT, 'A5', true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Dea Venditama');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        //line ini penting
        $this->response->setContentType('application/pdf');
        //Close and output PDF document
        $pdf->Output('invoice.pdf', 'i');
        // $this->pdf->Output('invoice.pdf', 'F');
    }
}
