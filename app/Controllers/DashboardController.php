<?php

namespace App\Controllers;

use App\Models\KendaraanModel;
use App\Models\KomplainModel;
use App\Models\PelangganModel;
use App\Models\PengirimanModel;
use App\Models\SettingModel;
use App\Models\SupirModel;

class DashboardController extends BaseController
{
    protected $modelSetting, $modelSupir, $modelKendaraan, $modelPelanggan, $modelPengiriman, $modelKomplain;
    public function __construct()
    {
        $modelSetting = new SettingModel();
        $modelSupir = new SupirModel();
        $modelKendaraan = new KendaraanModel();
        $modelPelanggan = new PelangganModel();
        $modelPengiriman = new PengirimanModel();
        $modelKomplain = new KomplainModel();
        
        $this->modelSetting = $modelSetting->asObject()->first();
        $this->modelSupir = $modelSupir->countAllResults();
        $this->modelKendaraan = $modelKendaraan->countAllResults();
        $this->modelPelanggan = $modelPelanggan->countAllResults();
        $this->modelPengiriman = $modelPengiriman->countAllResults();
        $this->modelKomplain = $modelKomplain->countAllResults();
    }

    public function index()
    {

        $data['total_supir'] = $this->modelSupir;
        $data['total_kendaraan'] = $this->modelKendaraan;
        $data['total_pelanggan'] = $this->modelPelanggan;
        $data['total_pengiriman'] = $this->modelPengiriman;
        $data['total_komplain'] = $this->modelKomplain;

        return view('index', $data);
    }
}
