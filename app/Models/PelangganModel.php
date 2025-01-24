<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table      = 'pelanggan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['no_ktp','nama','jenis_kelamin', 'alamat', 'telepon' ]; // Tambahkan 'no_ktp' dan 'jenis_kelamin'

}
