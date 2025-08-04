<?php

namespace App\Models;

use CodeIgniter\Model;

class SupirModel extends Model
{
    protected $table = 'supir';
    protected $primaryKey = 'id';
    protected $allowedFields = ['no_ktp','sim', 'nama_supir', 'alamat', 'telepon','status'];
}
