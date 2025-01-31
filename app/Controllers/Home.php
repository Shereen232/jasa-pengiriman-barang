<?php

namespace App\Controllers;

use App\Models\PengirimanModel;
use App\Models\SettingModel;

class Home extends BaseController
{
    protected $modelSetting;
    public function __construct()
    {
        $model = new SettingModel();
        $this->modelSetting = $model->asObject()->first();
    }

    public function index()
    {
        $setting = $this->modelSetting;
        $resi = $this->request->getVar('no_resi');

        $model = new PengirimanModel();
        $data['pengiriman'] = $model->getPengirimanByResi($resi);
        $data['setting'] = $setting;

        if (!$data['pengiriman']) session()->setFlashdata('error_message', 'No resi tidak ditemukan.');

        session()->setFlashdata('tracking_resi', $resi);

        return view('template/main', $data);
    }
}
