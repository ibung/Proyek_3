<?php

namespace App\Controllers;

use App\Models\PermintaanModel;

class DapurController extends BaseController
{
    public function index()
    {
        $permintaanModel = new PermintaanModel();

        // menyiapkna data untuk dikirim ke view
        $data = [
            'title'       => 'Status Permintaan Bahan',
            'permintaan'  => $permintaanModel->orderBy('created_at', 'DESC')->findAll(),
        ];
        
        return view('dapur_dashboard_view', $data);
    }
}