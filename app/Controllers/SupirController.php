<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SupirController extends BaseController
{
    public function index()
    {
        return view('data-master/supir/index');
    }

    public function tambah()
    {
        return view('data-master/supir/tambah');
    }
}
