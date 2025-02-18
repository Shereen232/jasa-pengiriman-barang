<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KendaraanModel;
use App\Models\SupirModel;

class KendaraanController extends BaseController
{
    public function index()
    {
        $kendaraanModel = new KendaraanModel();
        $data['kendaraan'] = $kendaraanModel->getKendaraanWithSupir();

        return view('data-master/kendaraan/index', $data);
    }

    public function tambah()
    {
        $supirModel = new SupirModel();
        $data['supir'] = $supirModel->findAll();

        return view('data-master/kendaraan/tambah', $data);
    }

    public function create()
    {
        $this->validate([
            'no_polisi' => 'required',
            'merk' => 'required',
            'no_mesin' => 'required',
            'warna' => 'required',
            'id_supir' => 'required',
        ]);

        $data = [
            'no_polisi' => $this->request->getPost('no_polisi'),
            'merk' => $this->request->getPost('merk'),
            'no_mesin' => $this->request->getPost('no_mesin'),
            'warna' => $this->request->getPost('warna'),
            'id_supir' => $this->request->getPost('id_supir'),
        ];

        $kendaraanModel = new KendaraanModel();
        $kendaraanModel->insert($data);

        return redirect()->to(base_url('data-master/kendaraan'))->with('success_message', 'Data kendaraan berhasil ditambahkan.');
    }

   public function edit($id)
    {
        $kendaraanModel = new KendaraanModel();
        $supirModel = new SupirModel();

        // Ambil data kendaraan berdasarkan ID
        $kendaraan = $kendaraanModel->find($id);
        if (!$kendaraan) {
            return redirect()->to(base_url('data-master/kendaraan'))->with('error', 'Data kendaraan tidak ditemukan.');
        }

        $data = [
            'kendaraan' => $kendaraan,
            'supir' => $supirModel->findAll(), // Ambil data supir untuk dropdown
        ];

        return view('data-master/kendaraan/edit', $data);
    }

    public function update($id)
    {
        $this->validate([
            'no_polisi' => 'required',
            'merk' => 'required',
            'no_mesin' => 'required',
            'warna' => 'required',
            'id_supir' => 'required',
        ]);

        $data = [
            'no_polisi' => $this->request->getPost('no_polisi'),
            'merk' => $this->request->getPost('merk'),
            'no_mesin' => $this->request->getPost('no_mesin'),
            'warna' => $this->request->getPost('warna'),
            'id_supir' => $this->request->getPost('id_supir'),
        ];

        $kendaraanModel = new KendaraanModel();
        $kendaraanModel->update($id, $data);

        return redirect()->to(base_url('data-master/kendaraan'))->with('success_message', 'Data kendaraan berhasil diperbarui.');
    }

    public function delete($id)
    {
        $kendaraanModel = new KendaraanModel();
        $kendaraanModel->delete($id);

        return redirect()->to('data-master/kendaraan')->with('success_message', 'Data Kendaraan berhasil dihapus');
    }
}
