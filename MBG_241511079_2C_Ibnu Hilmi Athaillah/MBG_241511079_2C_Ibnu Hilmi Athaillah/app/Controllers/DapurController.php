<?php

namespace App\Controllers;

use App\Models\PermintaanModel;
use App\Models\BahanBakuModel; // <-- TAMBAHKAN INI

class DapurController extends BaseController
{
    public function index()
    {
        $permintaanModel = new PermintaanModel();
        $bahanBakuModel = new BahanBakuModel(); // <-- TAMBAHKAN INI

        // Ambil data bahan baku yang statusnya BUKAN kadaluarsa dan jumlahnya DI ATAS 0
        $bahanTersedia = $bahanBakuModel->where('status !=', 'kadaluarsa')
                                        ->where('jumlah >', 0)
                                        ->orderBy('nama', 'ASC')
                                        ->findAll();
        
        // Ambil data riwayat permintaan seperti sebelumnya
        $riwayatPermintaan = $permintaanModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'title'                 => 'Dashboard Dapur',
            'bahan_baku_tersedia'   => $bahanTersedia,      // <-- DATA BARU
            'riwayat_permintaan'    => $riwayatPermintaan,  // <-- DATA LAMA
        ];
        
        return view('dapur_dashboard_view', $data);
    }
}