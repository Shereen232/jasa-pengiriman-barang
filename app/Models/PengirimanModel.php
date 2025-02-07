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
        'id_pelanggan',
        'penerima',
        'alamat_penerima',
        'nama_barang',
        'jumlah',
        'berat',
        'biaya_kirim',
        'id_kendaraan',
        'status'
    ];
    public function getPengiriman($id = null)
{
    $this->select('pengiriman.*, supir.nama as nama_supir');
    $this->join('supir', 'supir.id = pengiriman.id', 'left');

    if ($id) {
        return $this->where('pengiriman.id', $id)->first();
    }

    return $this->findAll();
}


    public function getPengirimanWithRelations()
    {
        return $this->select('pengiriman.*, kendaraan.no_polisi, kendaraan.merk, supir.nama AS nama_supir, pelanggan.nama_pelanggan AS nama_pelanggan')
                    ->join('kendaraan', 'kendaraan.id = pengiriman.id_kendaraan')
                    ->join('supir', 'kendaraan.id_supir = supir.id')
                    ->join('pelanggan', 'pengiriman.id_pelanggan = pelanggan.id_pelanggan')
                    ->findAll();
    }

    public function getPengirimanByResi($resi)
    {
        return $this->select('pengiriman.*, kendaraan.no_polisi, kendaraan.merk, supir.nama AS nama_supir')
                    ->join('kendaraan', 'kendaraan.id = pengiriman.id_kendaraan')
                    ->join('supir', 'kendaraan.id_supir = supir.id')
                    ->where('pengiriman.no_pengiriman', $resi)
                    ->asObject()
                    ->findAll();
    }
    
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
