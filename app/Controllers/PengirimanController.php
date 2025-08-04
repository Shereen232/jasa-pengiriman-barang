<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\PengirimanModel;
use App\Models\KendaraanModel;
use App\Models\PelangganModel;
use App\Models\SupirModel;

class PengirimanController extends BaseController
{
    protected $pengirimanModel;
    protected $kendaraanModel;
    protected $supirModel;
    protected $pelangganModel;

    public function __construct()
    {
        $this->pengirimanModel = new PengirimanModel();
        $this->kendaraanModel = new KendaraanModel();
        $this->supirModel = new SupirModel();
    }

    // Menampilkan daftar pengiriman
    public function index()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $status = $this->request->getGet('status');

        $data = [
            'pengiriman' => $this->pengirimanModel->getPengirimanWithRelations($startDate, $endDate, $status),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => $status,
        ];

        return view('pengiriman/index', $data);
    }

    // Form tambah pengiriman
    public function tambah()
    {
        // Ambil jenis barang dari request (default: 'benda mati')
        $jenis_barang = $this->request->getPost('jenis_barang') ?? 'benda mati';
        

        $data = [
            'no_pengiriman' => $this->pengirimanModel->generateNoPengiriman($jenis_barang),
            'kendaraan' => $this->kendaraanModel->getKendaraanWithSupir(),
            'jenis_barang' => $jenis_barang, // Kirim ke view
            'supir' => $this->supirModel->findAll()      
        ];

        return view('pengiriman/tambah', $data);
    }


    // Simpan data pengiriman
    public function create()
    {
        $validation = \Config\Services::validation();
        $validate = $this->validate([
            'nama_pengirim' => 'required',
            'alamat_pengirim' => 'required',
            'telepon_pengirim' => 'required',
            'tanggal' => 'required',
            'penerima' => 'required',
            'telepon_penerima' => 'required|numeric',
            'jenis_barang' => 'required',
            'nama_barang' => 'required',
            'jumlah' => 'required|integer',
            'berat' => 'required|decimal',
            'biaya_kirim' => 'required',
            'estimasi_pengiriman' => 'required',
            'id_kendaraan' => 'required',
            'id_supir1' => 'required',
            'id_supir2' => 'permit_empty',
        ]);

        if (!$validate) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $no_pengiriman = $this->pengirimanModel->generateNoPengiriman($this->request->getPost('jenis_barang'));

        $data = [
            'no_pengiriman' => $no_pengiriman,
            'tanggal' => $this->request->getPost('tanggal'),
            'nama_pengirim' => $this->request->getPost('nama_pengirim'),
            'alamat_pengirim' => $this->request->getPost('alamat_pengirim'),
            'telepon_pengirim' => $this->request->getPost('telepon_pengirim'),
            'penerima' => $this->request->getPost('penerima'),
            'alamat_penerima' => $this->request->getPost('alamat_penerima'),
            'telepon_penerima' => $this->request->getPost('telepon_penerima'),
            'jenis_barang' => $this->request->getPost('jenis_barang'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jumlah' => $this->request->getPost('jumlah'),
            'berat' => $this->request->getPost('berat'),
            'biaya_kirim' => $this->request->getPost('biaya_kirim'),
            'id_kendaraan' => $this->request->getPost('id_kendaraan'),
            'id_supir1' => $this->request->getPost('id_supir1'),
            'is_supir2' => $this->request->getPost('id_supir2'),
            'estimasi_pengiriman' => $this->request->getPost('estimasi_pengiriman'),
            'status' => 'Menunggu Pengiriman'
        ];

        $this->pengirimanModel->insert($data);

        return redirect()->to(base_url('pengiriman'))->with('success_message', 'Data pengiriman berhasil ditambahkan.');
    }
        
    public function edit($id)
    {
        $pengiriman = $this->pengirimanModel->find($id);
    
        if (!$pengiriman) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data pengiriman dengan ID $id tidak ditemukan.");
        }
    
        $data = [
            'pengiriman' => $pengiriman,
            'kendaraan' => $this->kendaraanModel->getKendaraanWithSupir(),
            'supir' => $this->supirModel->findAll()
        ];
    
        return view('pengiriman/edit', $data);
    }  

    public function update($id)
    {
        try {
            $validation = \Config\Services::validation();
            $validate = $this->validate([
                'nama_pengirim' => 'required',
                'alamat_pengirim' => 'required',
                'telepon_pengirim' => 'required',
                'tanggal' => 'required',
                'penerima' => 'required',
                'telepon_penerima' => 'required|numeric',
                'jenis_barang' => 'required',
                'nama_barang' => 'required',
                'jumlah' => 'required|integer',
                'berat' => 'required|decimal',
                'id_kendaraan' => 'required',
                'biaya_kirim' => 'required',
                'estimasi_pengiriman' => 'required',
                'id_supir1' => 'required',
                'id_supir2' => 'permit_empty',
                'status' => 'required|in_list[Menunggu Pengiriman,Dalam Perjalanan,Terkirim,Gagal Terkirim,Dibatalkan]',
            ]);

            if (!$validate) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            $data = [
                'nama_pengirim' => $this->request->getPost('nama_pengirim'),
                'alamat_pengirim' => $this->request->getPost('alamat_pengirim'),
                'telepon_pengirim' => $this->request->getPost('telepon_pengirim'),
                'tanggal' => $this->request->getPost('tanggal'),
                'penerima' => $this->request->getPost('penerima'),
                'alamat_penerima' => $this->request->getPost('alamat_penerima'),
                'telepon_penerima' => $this->request->getPost('telepon_penerima'),
                'jenis_barang' => $this->request->getPost('jenis_barang'),
                'nama_barang' => $this->request->getPost('nama_barang'),
                'jumlah' => $this->request->getPost('jumlah'),
                'berat' => $this->request->getPost('berat'),
                'biaya_kirim' => $this->request->getPost('biaya_kirim'),
                'estimasi_pengiriman' => $this->request->getPost('estimasi_pengiriman'),
                'id_supir1' => $this->request->getPost('id_supir1'),
                'id_supir2' => $this->request->getPost('id_supir2'),
                'id_kendaraan' => $this->request->getPost('id_kendaraan'),
                'status' => $this->request->getPost('status'),
            ];

            $this->pengirimanModel->update($id, $data);

            return redirect()->to(base_url('pengiriman'))->with('success_message', 'Data pengiriman berhasil diperbarui.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()
                            ->withInput()
                            ->with('error_message', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $this->pengirimanModel->delete($id);

        return redirect()->to('pengiriman')->with('success_message', 'Data Pengiriman berhasil dihapus');
    }

    public function cetakResi($id)
    {
        // Ambil data pengiriman berdasarkan ID
        $pengiriman = $this->pengirimanModel->find($id);
    
        // Jika data tidak ditemukan, tampilkan pesan error
        if (!$pengiriman) {
            return redirect()->to('pengiriman')->with('error_message', 'Data pengiriman tidak ditemukan.');
        }
    
        // Data untuk dikirim ke view (gunakan data dummy jika NULL)
        $data = [
            'no_pengiriman'   => $pengiriman['no_pengiriman'] ?? 'P00001',
            'nama_pengirim'   => $pengiriman['nama_pengirim'] ?? 'Nama Pengirim',
            'alamat_pengirim' => $pengiriman['alamat_pengirim'] ?? 'Alamat Pengirim',
            'telepon_pengirim' => $pengiriman['telepon_pengirim'] ?? '08xxxxxxxxxx',
            'nama_penerima'   => $pengiriman['penerima'] ?? 'Nama Penerima',
            'alamat_penerima' => $pengiriman['alamat_penerima'] ?? 'Alamat Penerima',
            'telepon_penerima' => $pengiriman['telepon_penerima'] ?? '08xxxxxxxxxx', // Tambahkan data dummy
            'nama_barang'     => $pengiriman['nama_barang'] ?? 'Nama Barang',
            'jumlah'          => $pengiriman['jumlah'] ?? 1,
            'berat'           => ($pengiriman['berat'] ?? 1) . ' Kg',
            'biaya_kirim'     => 'Rp ' . number_format($pengiriman['biaya_kirim'] ?? 20000, 0, ',', '.'),
            'tanggal_kirim'   => isset($pengiriman['tanggal']) ? date('d-m-Y', strtotime($pengiriman['tanggal'])) : date('d-m-Y'),
        ];
    
        // Load tampilan cetak_resi dengan data dari database
        $html = view('pengiriman/cetak_resi', ['data' => $data]);

    
        // Inisialisasi Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    
        // Output PDF
        $dompdf->stream('resi_pengiriman_' . $data['no_pengiriman'] . '.pdf', ['Attachment' => false]);
    }
    
    public function cetakPDF()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $status = $this->request->getGet('status');

        // Ambil data pengiriman berdasarkan filter
        $pengiriman = $this->pengirimanModel->getPengirimanWithRelations($startDate, $endDate, $status);

        // Kirim semua filter ke view
        $data = [
            'pengiriman' => $pengiriman,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ];

        // Load view sebagai HTML
        $html = view('pengiriman/pdf_pengiriman', $data);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $dompdf->stream('Data_Pengiriman.pdf', ['Attachment' => false]);
    }

    
}
