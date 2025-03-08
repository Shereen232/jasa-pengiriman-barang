<?php

namespace App\Controllers;

use App\Models\KomplainModel;
use CodeIgniter\Controller;

class KomplainController extends Controller
{
    protected $komplainModel;
    protected $helpers = ['url', 'form'];

    public function __construct()
    {
        $this->komplainModel = new KomplainModel();
    }

    // Menampilkan daftar komplain
    public function index()
    {
        $data['komplain'] = $this->komplainModel->findAll();
        return view('komplain/index', $data);
    }

    // Menampilkan form tambah komplain
    public function tambah()
    {
        return view('komplain/tambah');
    }

    // Menyimpan data komplain
    public function simpan()
    {
        $validation = \Config\Services::validation();

        // Aturan validasi
        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email',
            'komplain' => 'required|min_length[10]',
        ];
    
        if ($this->request->getMethod() === 'post') {
            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('validation', $validation);
            }

        // Simpan ke database
        $data = [
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'no_telp'  => $this->request->getPost('no_telp'),
            'no_resi'  => $this->request->getPost('no_resi'),
            'pesan'    => $this->request->getPost('pesan'),
            'status'   => 'Pending' // Status default
        ];
        $this->komplainModel->insert($data);

        return redirect()->to('/komplain/tambah')->with('success_message', 'Komplain berhasil ditambahkan');
        }
        return view('komplain/tambah');
    }

    // Menghapus komplain
    public function delete($id)
    {
        $this->komplainModel->delete($id);
        return redirect()->to('/komplain')->with('success_message', 'Komplain berhasil dihapus');
    }

    public function edit($id)
    {
        $komplainModel = new \App\Models\KomplainModel();
        $data['komplain'] = $komplainModel->find($id);

        if (!$data['komplain']) {
            return redirect()->to('/komplain')->with('error', 'Data tidak ditemukan.');
        }

        return view('komplain/edit', $data);
    }

    public function update($id)
    {
        $komplainModel = new \App\Models\KomplainModel(); 

        // Ambil data dari form
        $status = $this->request->getPost('status');

        // Pastikan data dikirim dengan benar sebelum update
        if (!$status) {
            return redirect()->back()->with('error', 'Status tidak boleh kosong');
        }

        // Update ke database
        $komplainModel->update($id, ['status' => $status]);

        return redirect()->to(base_url('komplain'))->with('success', 'Status berhasil diperbarui');
    }

}
