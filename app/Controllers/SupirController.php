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
            'nama_supir' => 'required',
            'alamat' => 'required',
            'telepon' => 'required|numeric'
        ];
    
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    
        $data = [
            'no_ktp' => $this->request->getPost('no_ktp'),
            'nama_supir' => $this->request->getPost('nama_supir'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon')
        ];
    
        $this->supirModel->insert($data);
    
        return redirect()->to(base_url('data-master/supir'))->with('success_message', 'Data supir berhasil ditambahkan.');
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
        'nama_supir' => 'required',
        'alamat' => 'required',
        'telepon' => 'required|numeric'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $data = [
        'no_ktp' => $this->request->getPost('no_ktp'),
        'nama_supir' => $this->request->getPost('nama_supir'),
        'alamat' => $this->request->getPost('alamat'),
        'telepon' => $this->request->getPost('telepon')
    ];

    $this->supirModel->update($id, $data);

    return redirect()->to(base_url('data-master/supir'))->with('success_message', 'Data supir berhasil diperbarui.');
}

}
