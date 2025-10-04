<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanModel extends Model
{
    protected $table            = 'permintaan';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['pemohon_id', 'tgl_masak', 'menu_makan', 'jumlah_porsi', 'status'];

    public function getWaitingRequestsWithUser()
    {
        return $this->select('permintaan.*, user.name as pemohon_nama')
                    ->join('user', 'user.id = permintaan.pemohon_id')
                    ->where('permintaan.status', 'menunggu')
                    ->orderBy('permintaan.created_at', 'ASC')
                    ->findAll();
    }
}