<?php

namespace App\Models;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $table = 'kendaraan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_kendaraan', 'no_polisi', 'merk', 'no_mesin', 'warna', 'id_supir', 'is_active', 'created_at', 'updated_at', 'deleted_at'];
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $deletedField = 'deleted_at';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    

    // Optional: Tambahkan fungsi join dengan tabel supir
    public function getKendaraanWithSupir()
    {
        return $this->select('kendaraan.*, supir.nama_supir AS supir')
                    ->join('supir', 'supir.id = kendaraan.id_supir')
                    ->findAll();
    }

}
