<?php

namespace App\Models;

use CodeIgniter\Model;

class PengirimanModel extends Model
{
    protected $table = 'pengiriman';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'no_pengiriman',
        'nama_pengirim',
        'alamat_pengirim',
        'tanggal',
        'penerima',
        'alamat_penerima',
        'telepon_penerima',
        'jenis_barang',
        'nama_barang',
        'jumlah',
        'berat',
        'biaya_kirim',
        'id_kendaraan',
        'status'
    ];
    public function getPengiriman($id = null)
    {
        $this->select('pengiriman.*, supir.nama_supir as nama_supir');
        $this->join('supir', 'supir.id = pengiriman.id', 'left');

        if ($id) {
            return $this->where('pengiriman.id', $id)->first();
        }

        return $this->findAll();
    }

    public function getPengirimanById($id)
{
    return $this->select('pengiriman.*, pelanggan.alamat AS alamat_pengirim')
                ->join('pelanggan', 'pelanggan.id_pelanggan = pengiriman.id_pelanggan', 'left')
                ->where('pengiriman.id', $id)
                ->get()
                ->getRow();
}


    public function getPengirimanWithRelations()
    {
        return $this->select('pengiriman.*, kendaraan.no_polisi, kendaraan.merk, supir.nama_supir AS nama_supir')
                    ->join('kendaraan', 'kendaraan.id = pengiriman.id_kendaraan')
                    ->join('supir', 'kendaraan.id_supir = supir.id')
                    ->findAll();
    }

    public function getPengirimanByResi($resi)
    {
        return $this->select('pengiriman.*, kendaraan.no_polisi, kendaraan.merk, supir.nama_supir AS nama_supir')
                    ->join('kendaraan', 'kendaraan.id = pengiriman.id_kendaraan')
                    ->join('supir', 'kendaraan.id_supir = supir.id')
                    ->where('pengiriman.no_pengiriman', $resi)
                    ->asObject()
                    ->findAll();
    }
    
    public function generateNoPengiriman($jenis_barang)
    {
        $kode = ($jenis_barang == 'Makhluk Hidup') ? 'PH' : 'PM'; // PH = Makhluk Hidup, PM = Benda Mati
        $bulan = date('m'); // Ambil bulan saat ini

        // Ambil nomor terakhir dengan prefix yang sesuai
        $lastRecord = $this->orderBy('no_pengiriman', 'DESC')->like('no_pengiriman', "$kode-$bulan", 'after')->first();

        if ($lastRecord) {
            $lastNumber = (int) substr($lastRecord['no_pengiriman'], -5);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $kode . '-' . $bulan . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }
  
}
