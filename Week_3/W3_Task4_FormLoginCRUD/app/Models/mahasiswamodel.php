<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nim', 'nama', 'umur'];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    /**
     * Mencari mahasiswa berdasarkan nama atau NIM
     */
    public function search($keyword)
    {
        return $this->like('nama', $keyword)
                   ->orLike('nim', $keyword)
                   ->orderBy('id', 'ASC')
                   ->findAll();
    }

    /**
     * Mendapatkan semua data mahasiswa
     */
    public function getAllMahasiswa()
    {
        return $this->orderBy('id', 'ASC')->findAll();
    }

    /**
     * Mendapatkan mahasiswa berdasarkan ID
     */
    public function getMahasiswaById($id)
    {
        return $this->find($id);
    }

    /**
     * Mendapatkan mahasiswa berdasarkan NIM (untuk kompatibilitas dengan kode awal)
     */
    public function getMahasiswaByNim($nim)
    {
        return $this->where('nim', $nim)->first();
    }

    /**
     * Menambah mahasiswa baru
     */
    public function createMahasiswa($data)
    {
        return $this->insert($data);
    }

    /**
     * Update data mahasiswa
     */
    public function updateMahasiswa($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Hapus mahasiswa
     */
    public function deleteMahasiswa($id)
    {
        return $this->delete($id);
    }
}