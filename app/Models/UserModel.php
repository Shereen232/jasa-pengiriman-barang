<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'username', 'password_hash', 'active'];

    // Method untuk mendapatkan semua data user
   
    // Method untuk mendapatkan user berdasarkan ID
    public function getUserById($id)
    {
        return $this->where('id', $id)->first();
    }
}
