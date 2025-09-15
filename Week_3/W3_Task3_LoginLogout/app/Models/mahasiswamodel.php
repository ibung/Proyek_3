<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'nim', 'nama', 'umur'];
    protected $returnType = 'array';
    
    public function getAllMahasiswa()
    {
        return $this->findAll();
    }
    
    public function getMahasiswaByNim($nim)
    {
        return $this->where('nim', $nim)->first();
    }
}