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
        // Validasi Input
        $validation = $this->validate([
            'no_ktp' => 'required',
            'nama_supir' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        if (!$validation) {
            // Jika validasi gagal, kembali ke halaman tambah dengan pesan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data dari form
        $data = [
            'no_ktp' => $this->request->getPost('no_ktp'),
            'nama' => $this->request->getPost('nama_supir'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
        ];

        // Simpan data ke database
        $this->supirModel->insert($data);

        // Redirect dengan pesan sukses
        return redirect()->to('data-master/supir')->with('success_message', 'Data Supir berhasil ditambahkan');
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
        // Validasi Input
        $validation = $this->validate([
            'no_ktp' => 'required',
            'nama_supir' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        if (!$validation) {
            // Jika validasi gagal, kembali ke halaman edit dengan pesan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data dari form
        $data = [
            'no_ktp' => $this->request->getPost('no_ktp'),
            'nama' => $this->request->getPost('nama_supir'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
        ];

        // Update data supir
        $this->supirModel->update($id, $data);

        // Redirect dengan pesan sukses
        return redirect()->to('data-master/supir')->with('success_message', 'Data Supir berhasil diperbarui');
    }
}
