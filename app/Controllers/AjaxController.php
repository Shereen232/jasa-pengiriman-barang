<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AjaxController extends Controller
{
    protected $db, $provinsi, $kabupaten, $kecamatan, $kelurahan;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getProvinsi()
    {
        $data = $this->db->table('tbl_provinsi')->get()->getResult();
        return $this->response->setJSON($data);
    }

    public function getKota($id_provinsi)
    {
        $data = $this->db->table('tbl_kabkot')->where('provinsi_id', $id_provinsi)->get()->getResult();
        return $this->response->setJSON($data);
    }

    public function getKecamatan($id_kota)
    {
        $data = $this->db->table('tbl_kecamatan')->where('kabkot_id', $id_kota)->get()->getResult();
        return $this->response->setJSON($data);
    }

    public function getKelurahan($id_kecamatan)
    {
        $data = $this->db->table('tbl_kelurahan')->where('kecamatan_id', $id_kecamatan)->get()->getResult();
        return $this->response->setJSON($data);
    }
    
    
}
