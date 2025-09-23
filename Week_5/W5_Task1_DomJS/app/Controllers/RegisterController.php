<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\StudentModel;

class RegisterController extends BaseController
{
    /**
     * Menampilkan halaman form untuk menambah mahasiswa baru.
     */
    public function index()
    {
        // Menambahkan judul untuk view
        $data = [
            'title' => 'Tambah Mahasiswa Baru'
        ];
        return view('register_view', $data);
    }

    /**
     * Memproses data dari form dan menyimpannya ke database.
     */
    public function process()
    {
        // Aturan Validasi
        $rules = [
            'full_name'  => 'required|min_length[3]',
            'nim'        => 'required|is_unique[students.nim]',
            'username'   => 'required|min_length[5]|is_unique[users.username]',
            'password'   => 'required|min_length[8]',
            'entry_year' => 'required|exact_length[4]|integer',
            'age'        => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Siapkan model dan database
        $userModel = new UserModel();
        $studentModel = new StudentModel();
        $db = \Config\Database::connect();
        
        // Mulai database transaction
        $db->transStart();

        // 1. Simpan ke tabel 'users'
        $userId = $userModel->insert([
            'username'  => $this->request->getVar('username'),
            'password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'full_name' => $this->request->getVar('full_name'),
            'role'      => 'mahasiswa' // Role default selalu mahasiswa
        ]);

        // 2. Simpan ke tabel 'students' menggunakan user_id dari user yang baru dibuat
        $studentModel->insert([
            'nim'        => $this->request->getVar('nim'),
            'age'        => $this->request->getVar('age'),
            'entry_year' => $this->request->getVar('entry_year'),
            'user_id'    => $userId
        ]);

        // Selesaikan transaction
        $db->transComplete();

        // Cek status transaction
        if ($db->transStatus() === FALSE) {
            return redirect()->back()->withInput()->with('error', 'Penambahan mahasiswa gagal, terjadi kesalahan server.');
        }

        // Arahkan kembali ke halaman daftar mahasiswa milik admin
        return redirect()->to('/admin/students')->with('success', 'Mahasiswa baru berhasil ditambahkan!');
    }
}