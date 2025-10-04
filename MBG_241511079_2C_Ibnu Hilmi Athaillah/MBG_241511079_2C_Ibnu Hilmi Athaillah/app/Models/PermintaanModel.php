<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanModel extends Model
{
    protected $table            = 'permintaan';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    
    // TAMBAHKAN 'created_at' DI SINI
    protected $allowedFields    = ['pemohon_id', 'tgl_masak', 'menu_makan', 'jumlah_porsi', 'status', 'created_at'];

    // Fungsi ini akan menjadi "otak" untuk mengambil data permintaan lengkap
    public function getRequestsWithDetails($statusFilter = null)
    {
        // 1. Ambil data permintaan utama, gabungkan dengan nama pemohon
        $builder = $this->select('permintaan.*, user.name as pemohon_nama')
                        ->join('user', 'user.id = permintaan.pemohon_id');

        // Jika ada filter status (misal: hanya 'menunggu'), terapkan
        if ($statusFilter) {
            $builder->where('permintaan.status', $statusFilter);
        }
        
        $permintaan_list = $builder->orderBy('permintaan.created_at', 'DESC')->findAll();

        // Jika tidak ada permintaan, kembalikan array kosong
        if (empty($permintaan_list)) {
            return [];
        }

        // 2. Ambil semua ID permintaan untuk query detail
        $permintaanIds = array_column($permintaan_list, 'id');
        
        // 3. Ambil semua detail bahan untuk semua permintaan di atas dalam satu query
        $detailModel = new PermintaanDetailModel();
        $details = $detailModel->select('permintaan_detail.*, bahan_baku.nama as nama_bahan, bahan_baku.satuan')
                               ->join('bahan_baku', 'bahan_baku.id = permintaan_detail.bahan_id')
                               ->whereIn('permintaan_detail.permintaan_id', $permintaanIds)
                               ->findAll();
        
        // 4. Kelompokkan detail bahan berdasarkan permintaan_id
        $detailsByPermintaanId = [];
        foreach ($details as $detail) {
            $detailsByPermintaanId[$detail['permintaan_id']][] = $detail;
        }

        // 5. Gabungkan detail ke dalam data permintaan utama
        foreach ($permintaan_list as $key => $permintaan) {
            $permintaan_list[$key]['details'] = $detailsByPermintaanId[$permintaan['id']] ?? [];
        }

        return $permintaan_list;
    }
}