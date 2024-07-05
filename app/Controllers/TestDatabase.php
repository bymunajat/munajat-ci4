<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TestDatabase extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        if ($db->connect()) {
            echo 'Koneksi basis data berhasil!';
        } else {
            echo 'Gagal terhubung ke basis data.';
        }
    }
}
