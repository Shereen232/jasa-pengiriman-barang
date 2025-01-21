<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class KendaraanController extends BaseController
{
    public function index()
    {
        return view('data-master/kendaraan/index');
    }
    public function tambah()
    {
        return view('data-master/kendaraan/tambah');
    }

}
