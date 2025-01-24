<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelangganModel;

class PelangganController extends BaseController
{
     // Menampilkan daftar pelanggan
    public function index()
    {
        $pelangganModel = new PelangganModel();
        $data['pelanggan'] = $pelangganModel->findAll(); // Mengambil semua data pelanggan

        return view('data-master/pelanggan/index', $data);
    }

    // Form tambah pelanggan
    public function tambah()
    {
        return view('data-master/pelanggan/tambah');
    }

    // Simpan data pelanggan ke database
    public function create()
    {
        // Validasi data input
        $this->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'no_ktp' => 'required|numeric|exact_length[16]',  // Menambahkan validasi no_ktp
            'jenis_kelamin' => 'required|in_list[Laki-laki,Perempuan]', // Validasi jenis kelamin
        ]);

        // Jika validasi gagal
        if (!$this->validate()) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Data pelanggan yang akan disimpan
        $data = [
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
            'no_ktp' => $this->request->getPost('no_ktp'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        ];

        // Memanggil model untuk menyimpan data
        $pelangganModel = new PelangganModel();
        $pelangganModel->insert($data);

        // Redirect setelah berhasil
        return redirect()->to(base_url('data-master/pelanggan'))->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    // Form edit pelanggan
    public function edit($id)
    {
        $pelangganModel = new PelangganModel();

        // Ambil data pelanggan berdasarkan ID
        $pelanggan = $pelangganModel->find($id);
        if (!$pelanggan) {
            return redirect()->to(base_url('data-master/pelanggan'))->with('error', 'Data pelanggan tidak ditemukan.');
        }

        $data = [
            'pelanggan' => $pelanggan,
        ];

        return view('data-master/pelanggan/edit', $data);
    }

    // Update data pelanggan
    public function update($id)
    {
        // Validasi input
        $this->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'no_ktp' => 'required|numeric|exact_length[16]',  // Menambahkan validasi no_ktp
            'jenis_kelamin' => 'required|in_list[Laki-laki,Perempuan]', // Validasi jenis kelamin
        ]);

        // Jika validasi gagal
        if (!$this->validate()) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Data yang akan diupdate
        $data = [
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
            'no_ktp' => $this->request->getPost('no_ktp'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        ];

        // Memanggil model untuk update data pelanggan
        $pelangganModel = new PelangganModel();
        $pelangganModel->update($id, $data);

        return redirect()->to(base_url('data-master/pelanggan'))->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    // Hapus data pelanggan
    public function delete($id)
    {
        $pelangganModel = new PelangganModel();
        $pelangganModel->delete($id);

        return redirect()->to(base_url('data-master/pelanggan'))->with('success', 'Data pelanggan berhasil dihapus.');
    }
}
