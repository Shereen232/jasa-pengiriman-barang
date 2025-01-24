<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table      = 'pelanggan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'alamat', 'telepon', 'no_ktp', 'jenis_kelamin']; // Tambahkan 'no_ktp' dan 'jenis_kelamin'

    // Validasi data jika diperlukan
    protected $validationRules = [
        'nama'          => 'required|min_length[3]',
        'alamat'        => 'required',
        'telepon'       => 'required|numeric',
        'no_ktp'        => 'required|numeric|exact_length[16]',  // Validasi untuk No KTP
        'jenis_kelamin' => 'required|in_list[Laki-laki,Perempuan]',  // Validasi untuk Jenis Kelamin
    ];

    // Fungsi untuk mengambil semua pelanggan
    public function getAllPelanggan()
    {
        return $this->findAll();
    }
}
