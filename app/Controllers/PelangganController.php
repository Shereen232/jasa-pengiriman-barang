<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PelangganModel;
use CodeIgniter\Validation\Validation;

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
        $validation = \Config\Services::validation();

        $rules = [
            'no_ktp' => 'required|numeric|min_length[16]|max_length[16]',
            'nama_pelanggan' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'telepon' => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'no_ktp' => $this->request->getPost('no_ktp'),
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
        ];

        $this->pelangganModel->insert($data);

        return redirect()->to(base_url('data-master/pelanggan'))->with('success_message', 'Data pelanggan berhasil ditambahkan.');
    }

    // Form edit pelanggan
    public function edit($id_pelanggan)
{
    $pelanggan = $this->pelangganModel->find($id_pelanggan);

    if (!$pelanggan) {
        return redirect()->to(base_url('data-master/pelanggan'))->with('error_message', 'Data tidak ditemukan.');
    }

    return view('data-master/pelanggan/edit', [
        'pelanggan' => $pelanggan,
        'validation' => session()->getFlashdata('errors')
    ]);
}

public function update($id_pelanggan)
{
    $validation = \Config\Services::validation();

    $rules = [
        'no_ktp' => 'required|numeric|min_length[16]|max_length[16]',
        'nama_pelanggan' => 'required',
        'jenis_kelamin' => 'required',
        'alamat' => 'required',
        'telepon' => 'required|numeric',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $data = [
        'no_ktp' => $this->request->getPost('no_ktp'),
        'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
        'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
        'alamat' => $this->request->getPost('alamat'),
        'telepon' => $this->request->getPost('telepon'),
    ];

    $this->pelangganModel->update($id_pelanggan, $data);

    return redirect()->to(base_url('data-master/pelanggan'))->with('success_message', 'Data pelanggan berhasil diperbarui.');
}

    // Hapus data pelanggan
    public function delete($id_pelanggan)
    {
        $this->pelangganModel->delete($id_pelanggan);

        return redirect()->to(base_url('data-master/pelanggan'))->with('success_message', 'Data pelanggan berhasil dihapus.');
    }
}
