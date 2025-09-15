<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;

class mahasiswa extends BaseController
{
    protected $mahasiswaModel;
    protected $validation;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->validation = \Config\Services::validation();
    }

    /**
     * Halaman utama - menampilkan daftar mahasiswa
     */
    public function index()
    {
        $keyword = $this->request->getGet('search');
        
        if (!empty($keyword)) {
            $mahasiswa = $this->mahasiswaModel->search($keyword);
        } else {
            $mahasiswa = $this->mahasiswaModel->getAllMahasiswa();
        }

        $data = [
            'title' => 'Daftar Mahasiswa - Website SMA XYZ',
            'mahasiswa' => $mahasiswa,
            'keyword' => $keyword ?? '',
            'editData' => null
        ];

        return view('mahasiswa_view', $data);
    }

    /**
     * Halaman edit - menampilkan form edit
     */
    public function edit($id = null)
    {
        if (!$id) {
            return redirect()->to('/mhs');
        }

        $editData = $this->mahasiswaModel->getMahasiswaById($id);
        
        if (!$editData) {
            session()->setFlashdata('error', 'Data mahasiswa tidak ditemukan.');
            return redirect()->to('/mhs');
        }

        $keyword = $this->request->getGet('search');
        
        if (!empty($keyword)) {
            $mahasiswa = $this->mahasiswaModel->search($keyword);
        } else {
            $mahasiswa = $this->mahasiswaModel->getAllMahasiswa();
        }

        $data = [
            'title' => 'Edit Mahasiswa - Website SMA XYZ',
            'mahasiswa' => $mahasiswa,
            'keyword' => $keyword ?? '',
            'editData' => $editData
        ];

        return view('mahasiswa_view', $data);
    }

    /**
     * Proses tambah mahasiswa baru
     */
    public function create()
    {
        // Validasi input
        $rules = [
            'nim'  => 'required|min_length[5]|max_length[20]',
            'nama' => 'required|min_length[2]|max_length[100]',
            'umur' => 'required|integer|greater_than[0]|less_than[150]'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', $this->validation->getErrors());
            return redirect()->back()->withInput();
        }

        // Ambil data dari form
        $data = [
            'nim'  => $this->request->getPost('nim'),
            'nama' => $this->request->getPost('nama'),
            'umur' => (int) $this->request->getPost('umur')
        ];

        // Simpan ke database
        if ($this->mahasiswaModel->createMahasiswa($data)) {
            session()->setFlashdata('success', 'Data mahasiswa berhasil ditambahkan.');
        } else {
            session()->setFlashdata('error', 'Gagal menambahkan data mahasiswa.');
        }

        return redirect()->to('/mhs');
    }

    /**
     * Proses update mahasiswa
     */
    public function update()
    {
        $id = $this->request->getPost('id');
        
        if (!$id) {
            session()->setFlashdata('error', 'ID mahasiswa tidak valid.');
            return redirect()->to('/mhs');
        }

        // Validasi input
        $rules = [
            'nim'  => 'required|min_length[5]|max_length[20]',
            'nama' => 'required|min_length[2]|max_length[100]',
            'umur' => 'required|integer|greater_than[0]|less_than[150]'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('errors', $this->validation->getErrors());
            return redirect()->back()->withInput();
        }

        // Ambil data dari form
        $data = [
            'nim'  => $this->request->getPost('nim'),
            'nama' => $this->request->getPost('nama'),
            'umur' => (int) $this->request->getPost('umur')
        ];

        // Update ke database
        if ($this->mahasiswaModel->updateMahasiswa($id, $data)) {
            session()->setFlashdata('success', 'Data mahasiswa berhasil diupdate.');
        } else {
            session()->setFlashdata('error', 'Gagal mengupdate data mahasiswa.');
        }

        return redirect()->to('/mhs');
    }

    /**
     * Hapus mahasiswa
     */
    public function delete($id = null)
    {
        if (!$id) {
            session()->setFlashdata('error', 'ID mahasiswa tidak valid.');
            return redirect()->to('/mhs');
        }

        // Cek apakah data ada
        $mahasiswa = $this->mahasiswaModel->getMahasiswaById($id);
        if (!$mahasiswa) {
            session()->setFlashdata('error', 'Data mahasiswa tidak ditemukan.');
            return redirect()->to('/mhs');
        }

        // Hapus data
        if ($this->mahasiswaModel->deleteMahasiswa($id)) {
            session()->setFlashdata('success', 'Data mahasiswa berhasil dihapus.');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data mahasiswa.');
        }

        return redirect()->to('/mhs');
    }

    /**
     * Halaman detail mahasiswa (tetap menggunakan NIM seperti kode awal)
     */
    public function detail($nim = null)
    {
        if (!$nim) {
            session()->setFlashdata('error', 'NIM mahasiswa tidak valid.');
            return redirect()->to('/mhs');
        }

        $mahasiswa = $this->mahasiswaModel->getMahasiswaByNim($nim);
        
        if (!$mahasiswa) {
            session()->setFlashdata('error', 'Data mahasiswa tidak ditemukan.');
            return redirect()->to('/mhs');
        }

        $data = [
            'title' => 'Detail Mahasiswa - Website SMA XYZ',
            'mahasiswa' => $mahasiswa
        ];

        return view('mahasiswa_detail_view', $data);
    }
}