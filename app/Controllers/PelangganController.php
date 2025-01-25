<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelangganModel;

class PelangganController extends BaseController
{
    protected $pelangganModel;

    public function __construct()
    {
        $this->pelangganModel = new PelangganModel();
    }

    // Menampilkan daftar pelanggan
    public function index()
    {
        $data = [
            'pelanggan' => $this->pelangganModel->getAllPelanggan(),
        ];

        return view('data-master/pelanggan/index', $data);
    }

    // Form tambah pelanggan
    public function tambah()
    {
        return view('data-master/pelanggan/tambah');
    }

    // Simpan data pelanggan
    public function create()
    {
        $this->validate([
            'no_ktp' => 'required',
            'nama_pelanggan' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        $data = [
            'no_ktp' => $this->request->getPost('no_ktp'),
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
        ];

        $this->pelangganModel->insert($data);

        return redirect()->to(base_url('data-master/pelanggan'))->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    // Form edit pelanggan
    public function edit($id_pelanggan)
    {
        $pelanggan = $this->pelangganModel->find($id_pelanggan);

        if (!$pelanggan) {
            return redirect()->to(base_url('data-master/pelanggan'))->with('error', 'Data pelanggan tidak ditemukan.');
        }

        $data = [
            'pelanggan' => $pelanggan,
        ];

        return view('data-master/pelanggan/edit', $data);
    }

    // Update data pelanggan
    public function update($id_pelanggan)
    {
        $this->validate([
            'no_ktp' => 'required',
            'nama_pelanggan' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        $data = [
            'no_ktp' => $this->request->getPost('no_ktp'),
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
        ];

        $this->pelangganModel->update($id_pelanggan, $data);

        return redirect()->to(base_url('data-master/pelanggan'))->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    // Hapus data pelanggan
    public function delete($id_pelanggan)
    {
        $this->pelangganModel->delete($id_pelanggan);

        return redirect()->to(base_url('data-master/pelanggan'))->with('success', 'Data pelanggan berhasil dihapus.');
    }
}
