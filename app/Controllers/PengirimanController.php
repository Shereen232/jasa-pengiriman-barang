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
            'penerima' => 'required',
            'alamat_penerima' => 'required',
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
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jumlah' => $this->request->getPost('jumlah'),
            'berat' => $berat,
            'biaya_kirim' => $biayaKirim,
            'id_kendaraan' => $this->request->getPost('id_kendaraan'),
            'status' => 'Menunggu Pengiriman'
        ];

        $this->pengirimanModel->insert($data);

        return redirect()->to(base_url('pengiriman'))->with('success', 'Data pengiriman berhasil ditambahkan.');
    }
    
    public function edit($id)
    {
        $pengiriman = $this->pengirimanModel->asObject()->find($id);
        $data = [
            'no_pengiriman' => $this->pengirimanModel->generateNoPengiriman(),
            'kendaraan'     => $this->kendaraanModel->getKendaraanWithSupir(),
            'pengirim'      => $this->pelangganModel->asObject()->findAll(),
            'pengiriman'    => $pengiriman
        ];

        return view('pengiriman/edit', $data);
    }

    public function update($id)
    {
        $this->validate([
            'id_pelanggan' => 'required',
            'penerima' => 'required',
            'alamat_penerima' => 'required',
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
            'nama_barang' => $this->request->getPost('nama_barang'),
            'jumlah' => $this->request->getPost('jumlah'),
            'berat' => $berat,
            'biaya_kirim' => $biayaKirim,
            'id_kendaraan' => $this->request->getPost('id_kendaraan'),
            'status' => $this->request->getPost('status')
        ];

        $this->pengirimanModel->update($id, $data);

        return redirect()->to(base_url('pengiriman'))->with('success', 'Data pengiriman berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->pengirimanModel->delete($id);

        return redirect()->to('pengiriman')->with('success', 'Data Pengiriman berhasil dihapus');
    }

    public function cetakResi($id)
    {
        $pengirimanModel = new PengirimanModel();
        $pengiriman = $pengirimanModel->find($id);
        
        if (!$pengiriman) {
            return redirect()->to('/pengiriman')->with('error', 'Data tidak ditemukan');
        }

        $options = new Options();
        $options->set('defaultFont', 'Helvetica');
        $dompdf = new Dompdf($options);

        $html = view('pengiriman/cetak_resi', ['pengiriman' => $pengiriman]);
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A6', 'portrait'); // Ukuran kertas A6 mirip dengan resi
        $dompdf->render();
        $dompdf->stream("resi_pengiriman_{$pengiriman['no_pengiriman']}.pdf", ['Attachment' => false]);
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
