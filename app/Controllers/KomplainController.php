<?php

namespace App\Controllers;

use App\Models\KomplainModel;
use App\Models\PengirimanModel;
use CodeIgniter\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;


class KomplainController extends Controller
{
    protected $komplainModel, $resiModel;


    public function __construct()
    {
        $this->komplainModel = new KomplainModel();
        $this->resiModel = new PengirimanModel();
    }

    // Menampilkan daftar komplain
    public function index()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
    
        $komplainModel = new \App\Models\KomplainModel();
    
        $komplain = $komplainModel->filterDate($startDate, $endDate);
    
        return view('komplain/index', [
            'komplain' => $komplain,
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);
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

        $isExist = $this->resiModel->where('no_pengiriman', $this->request->getPost('no_resi'))->first();

        if (!$isExist) return redirect()->back()->withInput()->with('error_message', 'No Resi tidak ditemukan');

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
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        // Load model
        $komplainModel = new \App\Models\KomplainModel();

        // Filter data berdasarkan tanggal jika tersedia
        if (!empty($startDate) && !empty($endDate)) {
            $data['komplain'] = $komplainModel->filterDate($startDate, $endDate);
        } else {
            $data['komplain'] = $komplainModel->findAll();
        }

        // Kirim data tanggal ke view
        $data['startDate'] = $startDate;
        $data['endDate']   = $endDate;

        // Jika kamu punya logo dan ingin base64 encode
        $imagePath = FCPATH . 'assets/img/logo.png'; // ganti path sesuai logo kamu
        if (file_exists($imagePath)) {
            $imageData = base64_encode(file_get_contents($imagePath));
            $data['imageBase64'] = 'data:image/png;base64,' . $imageData;
        } else {
            $data['imageBase64'] = '';
        }

        // Load view
        $html = view('komplain/pdf_komplain', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Tampilkan atau unduh file
        $dompdf->stream("Laporan_Komplain.pdf", ["Attachment" => 0]);
    }

    
    

}
