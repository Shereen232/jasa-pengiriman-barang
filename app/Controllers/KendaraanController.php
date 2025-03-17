<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KendaraanModel;
use App\Models\SupirModel;
use CodeIgniter\Validation\Validation;

class KendaraanController extends BaseController
{
    protected $kendaraanModel;

    public function __construct()
    {
        $this->kendaraanModel = new KendaraanModel();
    }

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
        $kendaraanModel = new KendaraanModel(); // Instansiasi di dalam method

        $validation = \Config\Services::validation();

        $rules = [
            'no_polisi' => 'required|is_unique[kendaraan.no_polisi]',
            'merk' => 'required',
            'no_mesin' => 'required|is_unique[kendaraan.no_mesin]',
            'warna' => 'required',
            'id_supir' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'no_polisi' => $this->request->getPost('no_polisi'),
            'merk' => $this->request->getPost('merk'),
            'no_mesin' => $this->request->getPost('no_mesin'),
            'warna' => $this->request->getPost('warna'),
            'id_supir' => $this->request->getPost('id_supir')
        ];

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
        $validation = \Config\Services::validation();

        $rules = [
            'no_polisi' => "required|is_unique[kendaraan.no_polisi,id,$id]",
            'merk' => 'required',
            'no_mesin' => "required|is_unique[kendaraan.no_mesin,id,$id]",
            'warna' => 'required',
            'id_supir' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'no_polisi' => $this->request->getPost('no_polisi'),
            'merk' => $this->request->getPost('merk'),
            'no_mesin' => $this->request->getPost('no_mesin'),
            'warna' => $this->request->getPost('warna'),
            'id_supir' => $this->request->getPost('id_supir')
        ];

        $this->kendaraanModel->update($id, $data);

        return redirect()->to(base_url('data-master/kendaraan'))->with('success_message', 'Data kendaraan berhasil diperbarui.');
    }


}
