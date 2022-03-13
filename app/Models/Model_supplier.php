<?php

namespace App\Models;

use CodeIgniter\Model;


class Model_supplier extends Model
{
    protected $table        = 'tabel_supplier';
    protected $primaryKey   = 'id_supplier';
    protected $allowedFields = ['id_supplier', 'nama', 'alamat', 'kota', 'telepon'];
    
    public function getNamaSupplier($id_sup)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT nama
                            FROM tabel_supplier
                            WHERE tabel_supplier.id_supplier = '$id_sup' ")->getResult('array');
        return $query;
    }
}