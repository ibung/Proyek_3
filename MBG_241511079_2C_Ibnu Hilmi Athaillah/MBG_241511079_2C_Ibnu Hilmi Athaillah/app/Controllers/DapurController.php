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

    // FUNGSI BARU: Menampilkan halaman form permintaan
    public function newRequest()
    {
        $bahanBakuModel = new BahanBakuModel();
        $data = [
            'title' => 'Buat Permintaan Bahan Baru',
            // Ambil hanya bahan yang statusnya tersedia/segera kadaluarsa
            'bahan_list' => $bahanBakuModel->whereIn('status', ['tersedia', 'segera_kadaluarsa'])
                                           ->where('jumlah >', 0)
                                           ->orderBy('nama', 'ASC')
                                           ->findAll()
        ];
        return view('dapur_permintaan_form_view', $data);
    }

    // FUNGSI BARU: Memproses dan menyimpan data permintaan
    public function createRequest()
    {
        $db = \Config\Database::connect();
        $permintaanModel = new PermintaanModel();
        $permintaanDetailModel = new PermintaanDetailModel();

        // Data utama permintaan
        $permintaanData = [
            'pemohon_id'    => session()->get('user_id'),
            'tgl_masak'     => $this->request->getPost('tgl_masak'),
            'menu_makan'    => $this->request->getPost('menu_makan'),
            'jumlah_porsi'  => $this->request->getPost('jumlah_porsi'),
            'status'        => 'menunggu'
        ];

        // Data detail bahan (berupa array)
        $bahan_ids = $this->request->getPost('bahan_id');
        $jumlah_diminta = $this->request->getPost('jumlah_diminta');

        // Validasi sederhana
        if (empty($bahan_ids) || empty($permintaanData['menu_makan'])) {
            return redirect()->back()->withInput()
                             ->with('error', 'Gagal! Menu masakan dan minimal satu bahan baku harus diisi.');
        }

        // Mulai transaksi database
        $db->transStart();

        // 1. Simpan data permintaan utama
        $permintaanModel->insert($permintaanData);
        // 2. Ambil ID dari permintaan yang baru saja dibuat
        $permintaanID = $permintaanModel->getInsertID();

        // 3. Simpan setiap detail bahan yang diminta
        foreach ($bahan_ids as $index => $bahan_id) {
            $detailData = [
                'permintaan_id' => $permintaanID,
                'bahan_id'      => $bahan_id,
                'jumlah_diminta'=> $jumlah_diminta[$index]
            ];
            $permintaanDetailModel->insert($detailData);
        }

        // Selesaikan transaksi
        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }

        return redirect()->to(site_url('dapur/dashboard'))
                         ->with('success', 'Permintaan bahan baku berhasil dibuat dan sedang menunggu persetujuan.');
    }
}