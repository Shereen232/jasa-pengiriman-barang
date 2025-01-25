<?php

namespace App\Models;

use CodeIgniter\Model;

class PengirimanModel extends Model
{
    protected $table = 'pengiriman';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'no_pengiriman',
        'tanggal',
        'nama_pengirim',
        'alamat_pengirim',
        'penerima',
        'alamat_penerima',
        'nama_barang',
        'jumlah',
        'berat',
        'biaya_kirim',
        'id_kendaraan',
        'id_supir'
    ];

    public function generateNoPengiriman()
    {
        $lastRecord = $this->orderBy('no_pengiriman', 'DESC')->first();
        if ($lastRecord) {
            $lastNumber = (int) substr($lastRecord['no_pengiriman'], -5);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return 'P' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }
}
