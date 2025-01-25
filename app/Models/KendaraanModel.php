<?php

namespace App\Models;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $table = 'kendaraan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['no_polisi', 'merk', 'no_mesin', 'warna', 'id_supir'];

    // Optional: Tambahkan fungsi join dengan tabel supir
    public function getKendaraanWithSupir()
    {
        return $this->select('kendaraan.*, supir.nama AS nama')
                    ->join('supir', 'supir.id = kendaraan.id_supir')
                    ->findAll();
    }

}
