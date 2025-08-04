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
        'telepon_pengirim',
        'tanggal',
        'penerima',
        'alamat_penerima',
        'telepon_penerima',
        'jenis_barang',
        'nama_barang',
        'jumlah',
        'berat',
        'biaya_kirim',
        'estimasi_pengiriman',
        'id_kendaraan',
        'id_supir1',
        'id_supir2',
        'status'
    ];

    public function getPengiriman($id = null)
    {
        $this->select('pengiriman.*, 
                       s1.nama_supir as nama_supir1, 
                       s2.nama_supir as nama_supir2');
        $this->join('supir as s1', 's1.id = pengiriman.id_supir1', 'left');
        $this->join('supir as s2', 's2.id = pengiriman.id_supir2', 'left');

        if ($id) {
            return $this->where('pengiriman.id', $id)->first();
        }

        return $this->findAll();
    }

    public function getPengirimanById($id)
    {
        return $this->select('pengiriman.*, 
                              s1.nama_supir as nama_supir1, 
                              s2.nama_supir as nama_supir2')
                    ->join('supir as s1', 's1.id = pengiriman.id_supir1', 'left')
                    ->join('supir as s2', 's2.id = pengiriman.id_supir2', 'left')
                    ->where('pengiriman.id', $id)
                    ->get()
                    ->getRow();
    }

    public function getPengirimanWithRelations($startDate = null, $endDate = null, $status = null)
    {
        $builder = $this->select('pengiriman.*, 
                                  kendaraan.no_polisi, 
                                  kendaraan.merk, 
                                  s1.nama_supir AS nama_supir1,
                                  s2.nama_supir AS nama_supir2')
                        ->join('kendaraan', 'kendaraan.id = pengiriman.id_kendaraan')
                        ->join('supir as s1', 's1.id = pengiriman.id_supir1', 'left')
                        ->join('supir as s2', 's2.id = pengiriman.id_supir2', 'left');

        if ($startDate && $endDate) {
            $builder->where('pengiriman.tanggal >=', $startDate)
                    ->where('pengiriman.tanggal <=', $endDate);
        }

        if ($status) {
            $builder->like('pengiriman.status', $status);
        }

        $builder->orderBy('pengiriman.id', 'DESC'); 

        return $builder->findAll();
    }

    public function getPengirimanByResi($resi)
    {
        return $this->select('pengiriman.*, 
                              kendaraan.no_polisi, 
                              kendaraan.merk,
                              s1.nama_supir as nama_supir1,
                              s2.nama_supir as nama_supir2')
                    ->join('kendaraan', 'kendaraan.id = pengiriman.id_kendaraan')
                    ->join('supir as s1', 's1.id = pengiriman.id_supir1', 'left')
                    ->join('supir as s2', 's2.id = pengiriman.id_supir2', 'left')
                    ->where('pengiriman.no_pengiriman', $resi)
                    ->asObject()
                    ->findAll();
    }

    public function generateNoPengiriman($jenis_barang)
    {
        $kode = ($jenis_barang == 'Makhluk Hidup') ? 'PH' : 'PM';
        $bulan = date('m');

        $lastRecord = $this->orderBy('no_pengiriman', 'DESC')
                           ->like('no_pengiriman', "$kode-$bulan", 'after')
                           ->first();

        if ($lastRecord) {
            $lastNumber = (int) substr($lastRecord['no_pengiriman'], -5);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $kode . '-' . $bulan . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }
}
