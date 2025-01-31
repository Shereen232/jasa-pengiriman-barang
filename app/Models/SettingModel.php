<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table = 'setting';
    protected $primaryKey = 'id';
    protected $allowedFields = ['about_content', 'footer_content'];
}
