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
        $this->pelangganModel = new PelangganModel();
    }

    // Menampilkan daftar pengiriman
    public function index()
    {
        $data = [
            'pengiriman' => $this->pengirimanModel->getPengirimanWithRelations(),
        ];

        return view('pengiriman/index', $data);
    }

    // Form tambah pengiriman
    public function tambah()
    {
        $data = [
            'no_pengiriman' => $this->pengirimanModel->generateNoPengiriman(),
            'kendaraan' => $this->kendaraanModel->getKendaraanWithSupir(),
            'pengirim' => $this->pelangganModel->asObject()->findAll()
        ];

        return view('pengiriman/tambah', $data);
    }

    // Simpan data pengiriman
    public function create()
    {
        $this->validate([
            'id_pelanggan' => 'required',
            'tanggal'=> 'required',
            'penerima' => 'required',
            'alamat_penerima' => 'required',
            'telepon_penerima' => 'required|numeric',
            'nama_barang' => 'required',
            'jumlah' => 'required|integer',
            'berat' => 'required|decimal',
            'id_kendaraan' => 'required',
        ]);
         // Perhitungan biaya pengiriman
         $berat = $this->request->getPost('berat'); // berat dalam kilogram
         $biayaPerKg = 10000; // Rp 10.000 per kg
         $biayaKirim = $berat * $biayaPerKg;

        $data = [
            'no_pengiriman' => $this->request->getPost('no_pengiriman'),
            'tanggal' => $this->request->getPost('tanggal'),
            'id_pelanggan' => $this->request->getPost('id_pelanggan'),
            'penerima' => $this->request->getPost('penerima'),
            'alamat_penerima' => $this->request->getPost('alamat_penerima'),
            'telepon_penerima' => $this->request->getPost('telepon_penerima'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jumlah' => $this->request->getPost('jumlah'),
            'berat' => $berat,
            'biaya_kirim' => $biayaKirim,
            'id_kendaraan' => $this->request->getPost('id_kendaraan'),
            'status' => 'Menunggu Pengiriman'
        ];

        $this->pengirimanModel->insert($data);

        return redirect()->to(base_url('pengiriman'))->with('success_message', 'Data pengiriman berhasil ditambahkan.');
    }
    
    public function edit($id) 
    {
        $pengiriman = $this->pengirimanModel->getPengirimanById($id);
    
        if (!$pengiriman) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    
        $data = [
            'no_pengiriman' => $this->pengirimanModel->generateNoPengiriman(),
            'kendaraan' => $this->kendaraanModel->getKendaraanWithSupir(),
            'pengirim' => $this->pelangganModel->asObject()->findAll(),
            'pengiriman' => $pengiriman // Ini harus objek
        ];
    
        return view('pengiriman/edit', $data);
    }
    

    public function update($id)
    {
        $this->validate([
            'id_pelanggan' => 'required',
            'tanggal'=> 'required',
            'penerima' => 'required',
            'alamat_penerima' => 'required',
            'telepon_penerima' => 'required|numeric',
            'nama_barang' => 'required',
            'jumlah' => 'required|integer',
            'berat' => 'required|decimal',
            'id_kendaraan' => 'required',
        ]);
         // Perhitungan biaya pengiriman
         $berat = $this->request->getPost('berat'); // berat dalam kilogram
         $biayaPerKg = 10000; // Rp 10.000 per kg
         $biayaKirim = $berat * $biayaPerKg;

        $data = [
            'no_pengiriman' => $this->request->getPost('no_pengiriman'),
            'tanggal' => $this->request->getPost('tanggal'),
            'id_pelanggan' => $this->request->getPost('id_pelanggan'),
            'penerima' => $this->request->getPost('penerima'),
            'alamat_penerima' => $this->request->getPost('alamat_penerima'),
            'telepon_penerima' => $this->request->getPost('telepon_penerima'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jumlah' => $this->request->getPost('jumlah'),
            'berat' => $berat,
            'biaya_kirim' => $biayaKirim,
            'id_kendaraan' => $this->request->getPost('id_kendaraan'),
            'status' => $this->request->getPost('status')
        ];

        $this->pengirimanModel->update($id, $data);

        return redirect()->to(base_url('pengiriman'))->with('success_message', 'Data pengiriman berhasil diperbarui.');
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
    
        // Ambil data pelanggan (pengirim)
        $pelanggan = $this->pelangganModel->find($pengiriman['id_pelanggan']);
    
        // Data untuk dikirim ke view (gunakan data dummy jika NULL)
        $data = [
            'no_pengiriman'   => $pengiriman['no_pengiriman'] ?? 'P00001',
            'nama_pengirim'   => $pelanggan['nama_pelanggan'] ?? 'Nama Pengirim',
            'alamat_pengirim' => $pelanggan['alamat'] ?? 'Alamat Pengirim',
            'telepon_pengirim' => $pelanggan['telepon'] ?? '08xxxxxxxxxx',
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
        $pengiriman = $this->pengirimanModel->getPengirimanWithRelations();

        // Load view HTML ke variabel
        $html = view('pengiriman/pdf_pengiriman', ['pengiriman' => $pengiriman]);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Download file PDF
        $dompdf->stream('Data_Pengiriman.pdf', ['Attachment' => false]);
    }

    
}
