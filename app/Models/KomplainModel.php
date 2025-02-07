<?php

namespace App\Models;

use CodeIgniter\Model;

class KomplainModel extends Model
{
    protected $table = 'komplain'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key tabel
    protected $allowedFields = ['nama', 'email', 'no_telp', 'no_resi', 'pesan', 'status'];    // Kolom yang bisa diisi

    // Set default values saat insert data baru
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
}
