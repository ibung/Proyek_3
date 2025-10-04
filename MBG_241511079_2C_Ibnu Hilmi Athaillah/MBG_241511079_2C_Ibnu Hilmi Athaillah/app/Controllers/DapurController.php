<?php

namespace App\Controllers;

use App\Models\PermintaanModel;
use App\Models\BahanBakuModel;
use App\Models\PermintaanDetailModel;

class DapurController extends BaseController
{
    public function index()
    {
        $permintaanModel = new PermintaanModel();
        $bahanBakuModel = new BahanBakuModel();
        
        $allBahan = $bahanBakuModel->getAllWithCalculatedStatus();
        
        $bahanTersedia = array_filter($allBahan, function($bahan) {
            return in_array($bahan['status'], ['tersedia', 'segera_kadaluarsa']);
        });

        $data = [
            'title'                 => 'Dashboard Dapur',
            'bahan_baku_tersedia'   => $bahanTersedia,
            'riwayat_permintaan'    => $permintaanModel->getRequestsWithDetails(),
        ];
        
        return view('dapur_dashboard_view', $data);
    }

    public function newRequest()
    {
        $bahanBakuModel = new BahanBakuModel();
        $data = [
            'title' => 'Buat Permintaan Bahan Baru',
            'bahan_list' => $bahanBakuModel->whereIn('status', ['tersedia', 'segera_kadaluarsa'])
                                           ->where('jumlah >', 0)
                                           ->orderBy('nama', 'ASC')
                                           ->findAll()
        ];
        return view('dapur_permintaan_form_view', $data);
    }

    public function createRequest()
    {
        $db = \Config\Database::connect();
        $permintaanModel = new PermintaanModel();
        $permintaanDetailModel = new PermintaanDetailModel();

        // ambil tanggal permintaan dari form, tambahkan waktu saat ini agar formatnya datetime
        $tanggalPermintaan = $this->request->getPost('created_at') . ' ' . date('H:i:s');

        // data utama permintaan
        $permintaanData = [
            'pemohon_id'    => session()->get('user_id'),
            'tgl_masak'     => $this->request->getPost('tgl_masak'),
            'menu_makan'    => $this->request->getPost('menu_makan'),
            'jumlah_porsi'  => $this->request->getPost('jumlah_porsi'),
            'status'        => 'menunggu',
            'created_at'    => $tanggalPermintaan, // gunakan tanggal dari form
        ];

        $bahan_ids = $this->request->getPost('bahan_id');
        $jumlah_diminta = $this->request->getPost('jumlah_diminta');

        if (empty($bahan_ids) || empty($permintaanData['menu_makan'])) {
            return redirect()->back()->withInput()
                             ->with('error', 'Gagal! Menu masakan dan minimal satu bahan baku harus diisi.');
        }

        $db->transStart();

        $permintaanModel->insert($permintaanData);
        $permintaanID = $permintaanModel->getInsertID();

        foreach ($bahan_ids as $index => $bahan_id) {
            $detailData = [
                'permintaan_id' => $permintaanID,
                'bahan_id'      => $bahan_id,
                'jumlah_diminta'=> $jumlah_diminta[$index]
            ];
            $permintaanDetailModel->insert($detailData);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }

        return redirect()->to(site_url('dapur/dashboard'))
                         ->with('success', 'Permintaan bahan baku berhasil dibuat dan sedang menunggu persetujuan.');
    }
}