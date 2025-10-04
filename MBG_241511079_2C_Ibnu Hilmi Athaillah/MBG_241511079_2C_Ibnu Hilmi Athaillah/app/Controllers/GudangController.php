<?php

namespace App\Controllers;

use App\Models\BahanBakuModel;

class GudangController extends BaseController
{
    public function index()
    {
        $bahanBakuModel = new BahanBakuModel();
        $data = [
            'title'      => 'Stok Bahan Baku',
            'bahan_baku' => $bahanBakuModel->orderBy('tanggal_kadaluarsa', 'ASC')->findAll(),
        ];
        return view('gudang_dashboard_view', $data);
    }


    // memanggil view form yang baru
    public function new()
    {
        $data = [
            'title' => 'Form Tambah Bahan Baku'
        ];
        return view('gudang_form_view', $data);
    }

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
}