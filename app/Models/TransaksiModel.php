<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table         = 'transaksi';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['id_barang', 'id_pembeli', 'jumlah', 'total_harga', 'created_date', 'created_by', 'updated_date', 'updated_by', 'alamat', 'ongkir', 'status'];
    protected $returnType    = '\App\Entities\Transaksi';
    protected $useTimestamps = false;
}
