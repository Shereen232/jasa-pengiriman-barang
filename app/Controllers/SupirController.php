<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SupirModel;

class SupirController extends BaseController
{
    protected $supirModel;

    public function __construct()
    {
        $this->supirModel = new SupirModel(); // Inisialisasi SupirModel
    }

    public function index()
    {
        // Ambil data dari tabel supir
        $data = [
            'supir' => $this->supirModel->findAll(), // Ambil semua data supir
        ];

        // Tampilkan view dan kirim data
        return view('data-master/supir/index', $data);
    }

    public function tambah()
    {
        return view('data-master/supir/tambah');
    }

    public function create()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'no_ktp' => 'required|numeric|min_length[16]|max_length[16]|is_unique[supir.no_ktp]',
            'sim' => 'required',
            'status' => 'required',
            'nama_supir' => 'required',
            'alamat' => 'required',
            'telepon' => 'required|numeric|min_length[10]'
        ];

        // Jalankan validasi
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Cek apakah no_ktp sudah ada di database
        $existingSupir = $this->supirModel->where('no_ktp', $this->request->getPost('no_ktp'))->first();

        if ($existingSupir) {
            return redirect()->back()->withInput()->with('errors', ['no_ktp' => 'Nomor KTP sudah terdaftar!']);
        }

        // Jika lolos validasi, simpan data supir
        $data = [
            'no_ktp' => $this->request->getPost('no_ktp'),
            'sim' => $this->request->getPost('sim'),
            'nama_supir' => $this->request->getPost('nama_supir'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
            'status' => $this->request->getPost('status')
        ];

        $this->supirModel->insert($data);

        return redirect()->to(base_url('data-master/supir'))->with('success_message', 'Data supir berhasil ditambahkan.');
    }

    public function checkKtp()
    {
        $field = $this->request->getGet('ktp');
        $c_length = strlen($field);

        if ($c_length < 16) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Kolom no_ktp harus memiliki minimal 16 karakter.'. ' Terisi: ' . $c_length]);
        }

        if (empty($field)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Field tidak valid!']);
        }

        $existing = $this->supirModel->where('no_ktp', $field)->first();

        if ($existing) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Nomor KTP: ' . ucfirst(str_replace('_', ' ', $field)) . ' sudah terdaftar!']);
        } else {
            return $this->response->setJSON(['status' => 'success']);
        }
    }


    public function delete($id)
    {
        // Hapus data supir berdasarkan ID
        $this->supirModel->delete($id);

        // Redirect dengan pesan sukses
        return redirect()->to('data-master/supir')->with('success_message', 'Data Supir berhasil dihapus');
    }

    public function edit($id)
    {
        $supirModel = new \App\Models\SupirModel();

        // Ambil data supir berdasarkan ID
        $supir = $supirModel->find($id);

        // Jika data tidak ditemukan, tampilkan error 404
        if (!$supir) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Supir dengan ID $id tidak ditemukan.");
        }

        // Kirim data ke view
        return view('data-master/supir/edit', ['supir' => $supir]);
    }


    public function update($id)
    {
        $validation = \Config\Services::validation();

        $rules = [
            'no_ktp' => "required|numeric|min_length[16]|max_length[16]|is_unique[supir.no_ktp,id,$id]",
            'sim' => 'required',
            'nama_supir' => 'required',
            'alamat' => 'required',
            'telepon' => 'required|numeric|min_length[10]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'no_ktp' => $this->request->getPost('no_ktp'),
            'sim' => $this->request->getPost('sim'),
            'nama_supir' => $this->request->getPost('nama_supir'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
            'status' => $this->request->getPost('status')
        ];

        $this->supirModel->update($id, $data);

        return redirect()->to(base_url('data-master/supir'))->with('success_message', 'Data supir berhasil diperbarui.');
    }

}
