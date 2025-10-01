<?php

namespace App\Controllers;

use App\Models\BahanBakuModel; // Tambahkan ini

class GudangController extends BaseController
{
    public function index()
    {
        $bahanBakuModel = new BahanBakuModel();
        
        // menyiapkan data untuk dikirim ke view
        $data = [
            'title'      => 'Stok Bahan Baku',
            'bahan_baku' => $bahanBakuModel->orderBy('tanggal_kadaluarsa', 'ASC')->findAll(),
        ];
        
        return view('gudang_dashboard_view', $data);
    }
}