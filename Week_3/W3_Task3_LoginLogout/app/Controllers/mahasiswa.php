<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;

class mahasiswa extends BaseController
{
    protected $mahasiswaModel;
    
    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Daftar Mahasiswa - Website SMA XYZ',
            'mahasiswa' => $this->mahasiswaModel->getAllMahasiswa()
        ];
        
        return view('mahasiswa_view', $data);
    }
    
    public function detail($nim)
    {
        $mahasiswa = $this->mahasiswaModel->getMahasiswaByNim($nim);
        
        $data = [
            'title' => 'Detail Mahasiswa - Website SMA XYZ',
            'mahasiswa' => $mahasiswa
        ];
        
        return view('mahasiswa_detail_view', $data);
    }
}