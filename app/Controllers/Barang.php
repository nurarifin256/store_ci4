<?php

namespace App\Controllers;

class Barang extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session    = session();
    }

    public function index()
    {
        $barangModel = new \App\Models\BarangModel();
        $barang = $barangModel->findAll();
        return view('barang/index', [
            'barang' => $barang
        ]);
    }

    public function view()
    {
        $id = $this->request->uri->getSegment(3);

        $barangModel = new \App\Models\BarangModel();

        $barang = $barangModel->find($id);

        return view('barang/view.php', [
            'barang' => $barang
        ]);
    }

    public function create()
    {
        if ($this->request->getPost()) {
            // jika ada data yg di post
            $data = $this->request->getPost();
            $this->validation->run($data, 'barang');
            $errors = $this->validation->getErrors();

            if (!$errors) {
                // simpan datanya
                $barangModel = new \App\Models\BarangModel();
                $barang      = new \App\Entities\Barang();

                $barang->fill($data);
                $barang->gambar       = $this->request->getFile('gambar');
                $barang->created_by   = $this->session->get('id');
                $barang->created_date = date("y-m-d H:i:s");

                $barangModel->save($barang);

                $id = $barangModel->insertID();

                // $segment = ['barang', 'view', $id];

                return redirect()->to('/Barang/view/' . $id);
            }
        }
        return view('barang/create');
    }

    public function update()
    {
        $id = $this->request->uri->getSegment(3);

        $barangModel = new \App\Models\BarangModel();
        $barang = $barangModel->find($id);

        if ($this->request->getPost()) {
            $data = $this->request->getPost();
            $this->validation->run($data, 'barangupdate');
            $errors = $this->validation->getErrors();

            if (!$errors) {
                $b = new \App\Entities\Barang();
                $b->id = $id;
                $b->fill($data);

                if ($this->request->getFile('gambar')->isValid()) {
                    $b->gambar = $this->request->getFile('gambar');
                }

                $b->updated_by = $this->session->get('id');
                $b->updated_date = date("Y-m-d H:i:s");

                $barangModel->save($b);

                return redirect()->to('/Barang/view/' . $id);
            }
        }

        return view('barang/update', [
            'barang' => $barang
        ]);

        // menit 5:24
    }

    public function delete()
    {
    }
}
