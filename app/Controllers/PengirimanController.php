<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengirimanModel;
use App\Models\KendaraanModel;
use App\Models\SupirModel;

class PengirimanController extends BaseController
{
    protected $pengirimanModel;
    protected $kendaraanModel;
    protected $supirModel;

    public function __construct()
    {
        $this->pengirimanModel = new PengirimanModel();
        $this->kendaraanModel = new KendaraanModel();
        $this->supirModel = new SupirModel();
    }

    // Menampilkan daftar pengiriman
    public function index()
    {
        $data = [
            'pengiriman' => $this->pengirimanModel->findAll(),
        ];

        return view('pengiriman/index', $data);
    }

    // Form tambah pengiriman
    public function tambah()
    {
        $data = [
            'no_pengiriman' => $this->pengirimanModel->generateNoPengiriman(),
            'kendaraan' => $this->kendaraanModel->findAll(),
            'supir' => $this->supirModel->findAll(),
        ];

        return view('pengiriman/tambah', $data);
    }

    // Simpan data pengiriman
    public function create()
    {
        $this->validate([
            'nama_pengirim' => 'required',
            'alamat_pengirim' => 'required',
            'penerima' => 'required',
            'alamat_penerima' => 'required',
            'nama_barang' => 'required',
            'jumlah' => 'required|integer',
            'berat' => 'required|decimal',
            'id_kendaraan' => 'required',
            'id_supir' => 'required',
        ]);
         // Perhitungan biaya pengiriman
         $berat = $this->request->getPost('berat'); // berat dalam kilogram
         $biayaPerKg = 10000; // Rp 10.000 per kg
         $biayaKirim = $berat * $biayaPerKg;

        $data = [
            'no_pengiriman' => $this->request->getPost('no_pengiriman'),
            'tanggal' => $this->request->getPost('tanggal'),
            'nama_pengirim' => $this->request->getPost('nama_pengirim'),
            'alamat_pengirim' => $this->request->getPost('alamat_pengirim'),
            'penerima' => $this->request->getPost('penerima'),
            'alamat_penerima' => $this->request->getPost('alamat_penerima'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jumlah' => $this->request->getPost('jumlah'),
            'berat' => $berat,
            'biaya_kirim' => $biayaKirim,
            'id_kendaraan' => $this->request->getPost('id_kendaraan'),
            'id_supir' => $this->request->getPost('id_supir'),
        ];

        $this->pengirimanModel->insert($data);

        return redirect()->to(base_url('pengiriman'))->with('success', 'Data pengiriman berhasil ditambahkan.');
    }
    
}
