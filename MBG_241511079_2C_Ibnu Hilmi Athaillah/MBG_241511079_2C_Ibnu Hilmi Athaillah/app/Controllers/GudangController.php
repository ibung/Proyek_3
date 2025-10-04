<?php

namespace App\Controllers;

use App\Models\BahanBakuModel;
use App\Models\PermintaanModel;
use App\Models\PermintaanDetailModel;

class GudangController extends BaseController
{
    // Menampilkan dashboard stok bahan baku
    public function index()
    {
        $bahanBakuModel = new BahanBakuModel();
        $data = [
            'title'      => 'Stok Bahan Baku',
            'bahan_baku' => $bahanBakuModel->orderBy('tanggal_kadaluarsa', 'ASC')->findAll(),
        ];
        return view('gudang_dashboard_view', $data);
    }

    // Menampilkan form tambah
    public function new()
    {
        $data = [
            'title' => 'Form Tambah Bahan Baku'
        ];
        return view('gudang_form_view', $data);
    }

    // Memproses data dari form tambah
    public function create()
    {
        $model = new BahanBakuModel();
        $data = [
            'nama'               => $this->request->getPost('nama'),
            'kategori'           => $this->request->getPost('kategori'),
            'jumlah'             => $this->request->getPost('jumlah'),
            'satuan'             => $this->request->getPost('satuan'),
            'tanggal_masuk'      => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'status'             => 'tersedia',
        ];

        $model->save($data);
        return redirect()->to(site_url('gudang/dashboard'))->with('success', 'Data bahan baku berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $model = new BahanBakuModel();
        $data = [
            'title' => 'Form Edit Bahan Baku',
            'bahan' => $model->find($id)
        ];
        return view('gudang_form_view', $data);
    }

    // Memproses data dari form edit
    public function update($id)
    {
        $model = new BahanBakuModel();
        $data = [
            'nama'               => $this->request->getPost('nama'),
            'kategori'           => $this->request->getPost('kategori'),
            'jumlah'             => $this->request->getPost('jumlah'),
            'satuan'             => $this->request->getPost('satuan'),
            'tanggal_masuk'      => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'status'             => $this->request->getPost('status'),
        ];

        $model->update($id, $data);
        return redirect()->to(site_url('gudang/dashboard'))->with('success', 'Data bahan baku berhasil diubah.');
    }

    // Menghapus data
    public function delete($id)
    {
        $bahanBakuModel = new BahanBakuModel();
        $permintaanDetailModel = new PermintaanDetailModel();

        $isInUse = $permintaanDetailModel->where('bahan_id', $id)->first();

        if ($isInUse) {
            return redirect()->to(site_url('gudang/dashboard'))
                             ->with('error', 'Gagal menghapus! Bahan baku ini sedang digunakan dalam data permintaan.');
        }

        $bahanBakuModel->where('id', $id)->delete();
        
        return redirect()->to(site_url('gudang/dashboard'))
                         ->with('success', 'Data bahan baku berhasil dihapus.');
    }

    // Menampilkan daftar permintaan
    public function permintaanList()
    {
        $permintaanModel = new PermintaanModel();
        $data = [
            'title' => 'Daftar Permintaan Bahan',
            'requests' => $permintaanModel->getWaitingRequestsWithUser()
        ];
        return view('gudang_permintaan_view', $data);
    }
}