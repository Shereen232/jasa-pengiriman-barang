<?php

namespace App\Controllers;

use App\Models\KomplainModel;
use CodeIgniter\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;


class KomplainController extends Controller
{
    protected $komplainModel;


    public function __construct()
    {
        $this->komplainModel = new KomplainModel();
    }

    // Menampilkan daftar komplain
    public function index()
    {
        // Ambil status dari query string (GET)
        $status = $this->request->getGet('status');
    
        if (!empty($status)) {
            // Jika ada filter status, ambil data berdasarkan status
            $data['komplain'] = $this->komplainModel->where('status', $status)->findAll();
        } else {
            // Jika tidak ada filter, ambil semua data
            $data['komplain'] = $this->komplainModel->findAll();
        }
    
        // Kirim juga status untuk tetap mengisi dropdown filter di view
        $data['status_filter'] = $status;
    
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
        // Aturan validasi
        $rules = [
            'nama'     => 'required|min_length[3]',
            'email'    => 'required|valid_email',
            'no_telp'  => 'required|numeric',
            'no_resi'  => 'required',
            'pesan'    => 'required|min_length[5]',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        // Simpan ke database
        $data = [
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'no_telp'  => $this->request->getPost('no_telp'),
            'no_resi'  => $this->request->getPost('no_resi'),
            'pesan'    => $this->request->getPost('pesan'),
            'status'   => 'Pending',
        ];
        
        $komplainModel = new \App\Models\KomplainModel();
        $komplainModel->insert($data);

        return redirect()->to('/komplain/tambah')->with('message', 'Komplain berhasil dikirim!');
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

        
    public function generatePdf()
    {
        // Ambil parameter status dari URL
        $status = $this->request->getGet('status');

        // Ambil data sesuai status (jika ada), jika tidak tampilkan semua
        if (!empty($status)) {
            $data['komplain'] = $this->komplainModel->where('status', $status)->findAll();
        } else {
            $data['komplain'] = $this->komplainModel->findAll();
        }
        // Load view dengan data yang sudah difilter
        $html = view('komplain/pdf_komplain', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        
        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output PDF (bisa langsung didownload atau ditampilkan)
        $dompdf->stream("Laporan_Komplain.pdf", ["Attachment" => 0]); // Set Attachment => 1 untuk langsung mengunduh
    }

    

}
