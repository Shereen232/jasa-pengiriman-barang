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
        $data['kendaraan'] = $kendaraanModel->withDeleted()->findAll();

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
            'nama_kendaraan' => 'required',
            'no_polisi' => 'required|is_unique[kendaraan.no_polisi]',
            'merk' => 'required',
            'no_mesin' => 'required|is_unique[kendaraan.no_mesin]',
            'warna' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama_kendaraan' => $this->request->getPost('nama_kendaraan'),
            'no_polisi' => $this->request->getPost('no_polisi'),
            'merk' => $this->request->getPost('merk'),
            'no_mesin' => $this->request->getPost('no_mesin'),
            'warna' => $this->request->getPost('warna'),
            'is_active' => 1
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
            'nama_kendaraan' => 'required',
            'no_polisi' => "required|is_unique[kendaraan.no_polisi,id,$id]",
            'merk' => 'required',
            'no_mesin' => "required|is_unique[kendaraan.no_mesin,id,$id]",
            'warna' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama_kendaraan' => $this->request->getPost('nama_kendaraan'),
            'no_polisi' => $this->request->getPost('no_polisi'),
            'merk' => $this->request->getPost('merk'),
            'no_mesin' => $this->request->getPost('no_mesin'),
            'warna' => $this->request->getPost('warna'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0, // Tambahkan status aktif/nonaktif
        ];

        $this->kendaraanModel->update($id, $data);

        return redirect()->to(base_url('data-master/kendaraan'))->with('success_message', 'Data kendaraan berhasil diperbarui.');
    }

    public function ubahStatus($id, $status)
    {
        $kendaraanModel = new \App\Models\KendaraanModel();

        if ($status == 0) {
            // Nonaktifkan (soft delete)
            $kendaraanModel->delete($id);
            session()->setFlashdata('success_message', 'Kendaraan berhasil dinonaktifkan.');
        } else {
            // Aktifkan kembali
            $kendaraanModel->withDeleted()
                ->where('id', $id)
                ->set(['deleted_at' => null])
                ->update();
            session()->setFlashdata('success_message', 'Kendaraan berhasil diaktifkan.');
        }

        return redirect()->to(base_url('data-master/kendaraan'));
    }


}
