<?php

namespace App\Controllers;

use App\Models\BahanBakuModel;
use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;

class GudangController extends BaseController
{
    // menampilkan dashboard stok bahan baku
    public function index()
    {
        $bahanBakuModel = new BahanBakuModel();
        $data = [
            'title'      => 'Stok Bahan Baku',
            'bahan_baku' => $bahanBakuModel->getAllWithCalculatedStatus(),
        ];
        return view('gudang_dashboard_view', $data);
    }

    // menampilkan form tambah
    public function new()
    {
        $data = [
            'title' => 'Form Tambah Bahan Baku'
        ];
        return view('gudang_form_view', $data);
    }

    // memproses data dari form tambah
    public function create()
    {
        $jumlah = $this->request->getPost('jumlah');

        // VALIDASI: Jumlah tidak boleh negatif
        if ($jumlah < 0) {
            // Kembalikan ke form dengan pesan error
            return redirect()->back()->withInput()->with('error', 'Jumlah bahan baku tidak boleh kurang dari 0.');
        }

        $model = new BahanBakuModel();
        $data = [
            'nama'               => $this->request->getPost('nama'),
            'kategori'           => $this->request->getPost('kategori'),
            'jumlah'             => $jumlah,
            'satuan'             => $this->request->getPost('satuan'),
            'tanggal_masuk'      => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'status'             => 'tersedia',
        ];

        $model->save($data);
        return redirect()->to(site_url('gudang/dashboard'))->with('success', 'Data bahan baku berhasil ditambahkan.');
    }

    // menampilkan form edit
    public function edit($id)
    {
        $model = new BahanBakuModel();
        $data = [
            'title' => 'Form Edit Bahan Baku',
            'bahan' => $model->find($id)
        ];
        return view('gudang_form_view', $data);
    }

    // memproses data dari form edit
    public function update($id)
    {
        $jumlah = $this->request->getPost('jumlah');

        // VALIDASI: Jumlah tidak boleh negatif
        if ($jumlah < 0) {
            // Kembalikan ke form edit dengan pesan error
            return redirect()->to(site_url('gudang/bahan/edit/' . $id))->withInput()->with('error', 'Jumlah bahan baku tidak boleh kurang dari 0.');
        }

        $model = new BahanBakuModel();
        $data = [
            'nama'               => $this->request->getPost('nama'),
            'kategori'           => $this->request->getPost('kategori'),
            'jumlah'             => $jumlah,
            'satuan'             => $this->request->getPost('satuan'),
            'tanggal_masuk'      => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
        ];

        $model->update($id, $data);
        return redirect()->to(site_url('gudang/dashboard'))->with('success', 'Data bahan baku berhasil diubah.');
    }

    // menghapus data
    public function delete($id)
    {
        $bahanBakuModel = new BahanBakuModel();
        $permintaanDetailModel = new PermintaanDetailModel();

        // Ambil SEMUA bahan dengan status yang sudah dihitung dengan benar
        $semuaBahan = $bahanBakuModel->getAllWithCalculatedStatus();
        
        // Cari bahan yang ingin dihapus dari data yang sudah diproses
        $bahanUntukDihapus = null;
        foreach ($semuaBahan as $bahan) {
            if ($bahan['id'] == $id) {
                $bahanUntukDihapus = $bahan;
                break;
            }
        }

        // Jika statusnya BUKAN 'kadaluarsa' berdasarkan perhitungan Model
        if ($bahanUntukDihapus && $bahanUntukDihapus['status'] !== 'kadaluarsa') {
            return redirect()->to(site_url('gudang/dashboard'))
                             ->with('error', 'Bahan baku tidak bisa dihapus karena belum kadaluarsa.');
        }

        // Cek apakah bahan digunakan di tempat lain
        if ($permintaanDetailModel->where('bahan_id', $id)->first()) {
            return redirect()->to(site_url('gudang/dashboard'))
                             ->with('error', 'Gagal menghapus! Bahan ini digunakan dalam data permintaan.');
        }

        // Jika lolos, baru hapus
        $bahanBakuModel->delete($id);
        
        return redirect()->to(site_url('gudang/dashboard'))
                         ->with('success', 'Data bahan baku yang kadaluarsa berhasil dihapus.');
    }

    // Menampilkan daftar permintaan
    public function permintaanList()
    {
        $permintaanModel = new PermintaanModel();
        
        // Ambil SEMUA permintaan lengkap dengan detailnya
        $allRequests = $permintaanModel->getRequestsWithDetails();

        // Bagi data menjadi dua grup
        $waitingRequests = [];
        $historyRequests = [];
        foreach ($allRequests as $request) {
            if ($request['status'] == 'menunggu') {
                $waitingRequests[] = $request;
            } else {
                $historyRequests[] = $request;
            }
        }

        $data = [
            'title' => 'Daftar Permintaan Bahan',
            'waiting_requests' => $waitingRequests, // Data permintaan menunggu
            'history_requests' => $historyRequests, // Data riwayat
        ];
        return view('gudang_permintaan_view', $data);
    }

    // menoolak request
    public function rejectRequest($id)
    {
        $permintaanModel = new PermintaanModel();
        $permintaanModel->update($id, ['status' => 'ditolak']);

        return redirect()->to(site_url('gudang/permintaan'))
                         ->with('success', 'Permintaan telah berhasil ditolak.');
    }

    // menerima request
    public function approveRequest($id)
    {
        $permintaanModel = new PermintaanModel();
        $permintaanDetailModel = new PermintaanDetailModel();
        $bahanBakuModel = new BahanBakuModel();
        $db = \Config\Database::connect();
        
        $requestedItems = $permintaanDetailModel->where('permintaan_id', $id)->findAll();
        
        // LANGKAH 1: Cek semua bahan terlebih dahulu
        $insufficientItems = []; // Siapkan wadah untuk bahan yang kurang
        foreach ($requestedItems as $item) {
            $bahan = $bahanBakuModel->find($item['bahan_id']);

            if (!$bahan || $bahan['jumlah'] < $item['jumlah_diminta']) {
                // Jika kurang, catat namanya
                $insufficientItems[] = esc($bahan['nama'] ?? 'ID ' . $item['bahan_id']);
            }
        }

        // LANGKAH 2: Jika ada bahan yang kurang, batalkan dan beri pesan lengkap
        if (!empty($insufficientItems)) {
            // Gabungkan semua nama bahan yang kurang menjadi satu pesan
            $error_message = 'Gagal! Stok tidak mencukupi untuk bahan: ' . implode(', ', $insufficientItems) . '.';
            return redirect()->to(site_url('gudang/permintaan'))->with('error', $error_message);
        }

        // LANGKAH 3: Jika semua bahan aman, baru proses pengurangan stok
        $db->transStart();

        foreach ($requestedItems as $item) {
            $bahan = $bahanBakuModel->find($item['bahan_id']);
            $stok_baru = $bahan['jumlah'] - $item['jumlah_diminta'];
            
            $updateData = ['jumlah' => $stok_baru];
            if ($stok_baru <= 0) {
                $updateData['status'] = 'habis';
            }
            $bahanBakuModel->update($item['bahan_id'], $updateData);
        }

        $permintaanModel->update($id, ['status' => 'disetujui']);
        $db->transComplete();

        if ($db->transStatus() === false) {
             return redirect()->to(site_url('gudang/permintaan'))->with('error', 'Terjadi kesalahan saat memproses permintaan.');
        }

        return redirect()->to(site_url('gudang/permintaan'))->with('success', 'Permintaan berhasil disetujui dan stok telah diperbarui.');
    }
}