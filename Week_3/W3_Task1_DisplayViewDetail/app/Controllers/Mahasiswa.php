<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    // Menampilkan daftar mahasiswa
    public function index()
    {
        $model = new MahasiswaModel();
        $data['mahasiswa'] = $model->findAll();

        return view('mahasiswa/v_display_mahasiswa', $data);
    }

    // Menampilkan detail mahasiswa berdasarkan ID
    public function detail($id)
    {
        $model = new MahasiswaModel();
        $data['mahasiswa'] = $model->find($id);

        return view('mahasiswa/detail', $data);
    }
}
