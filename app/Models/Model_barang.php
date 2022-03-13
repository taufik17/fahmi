<?php

namespace App\Models;

use CodeIgniter\Model;


class Model_barang extends Model
{
    protected $table        = 'tabel_barang';
    protected $primaryKey   = 'id_barang';
    protected $allowedFields = ['id_barang', 'kategori', 'nama_barang', 'harga', 'stok', 'supplier', 'id_sup'];
    
    public function getDataBarang()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * 
                            FROM tabel_barang INNER JOIN tabel_supplier 
                            ON tabel_barang.id_sup = tabel_supplier.id_supplier")->getResult('array');
        return $query;
    }

    public function getUpdate($kategori, $nama_barang, $harga, $stok, $supplier, $id_barang) {
        $db = \Config\Database::connect();
        $query = $db->query("UPDATE tabel_barang 
                            SET kategori = '$kategori', nama_barang = '$nama_barang', harga = '$harga', stok = '$stok', id_sup = '$supplier', supplier = '$supplier' \
                            WHERE tabel_barang.id_barang = '$id_barang'");
        return $query;
    }
}