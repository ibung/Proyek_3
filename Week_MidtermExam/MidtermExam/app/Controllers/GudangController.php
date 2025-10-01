<?php

namespace App\Controllers;

use App\Models\BahanBakuModel;

class GudangController extends BaseController
{
    // menampilkan data
    public function index()
    {
        $bahanBakuModel = new BahanBakuModel();
        $data = [
            'title'      => 'Stok Bahan Baku',
            'bahan_baku' => $bahanBakuModel->orderBy('tanggal_kadaluarsa', 'ASC')->findAll(),
        ];
        return view('gudang_dashboard_view', $data);
    }

    // menampilkan tombol tambah
    public function new()
    {
        $data = [
            'title' => 'Form Tambah Bahan Baku'
        ];
        return view('gudang_add_bahan_view', $data);
    }

    // proses data dari form tambah
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
            'status'             => 'tersedia', // Status default saat pertama kali dibuat
        ];

        $model->save($data);
        return redirect()->to(site_url('gudang/dashboard'))->with('success', 'Data bahan baku berhasil ditambahkan.');
    }
}