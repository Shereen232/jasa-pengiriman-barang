<?php

namespace App\Controllers;

class KomplainController extends BaseController
{
    public function index(): string
    {
        return view('komplain/tambah.php');
    }
}
