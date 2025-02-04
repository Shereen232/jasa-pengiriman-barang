<?php

namespace App\Models;

use CodeIgniter\Model;

class KomplainModel extends Model
{
    protected $table = 'komplain';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'email', 'no_telp', 'no_resi', 'pesan', 'created_at'];

    // Mendapatkan semua komplain
    public function getAllKomplain()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    // Mendapatkan komplain berdasarkan ID
    public function getKomplainById($id)
    {
        return $this->where('id', $id)->first();
    }
}
