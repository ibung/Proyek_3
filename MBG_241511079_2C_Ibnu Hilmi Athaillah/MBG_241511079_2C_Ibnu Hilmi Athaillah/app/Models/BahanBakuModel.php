<?php

namespace App\Models;

use CodeIgniter\Model;

class BahanBakuModel extends Model
{
    protected $table            = 'bahan_baku';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama', 'kategori', 'jumlah', 'satuan', 'tanggal_masuk', 'tanggal_kadaluarsa', 'status'];

    public function getAllWithCalculatedStatus()
    {
        $allBahan = $this->orderBy('tanggal_kadaluarsa', 'ASC')->findAll();
        
        $processedBahan = [];

        foreach ($allBahan as $bahan) {
            // Patokan sekarang adalah tanggal masuk dari bahan itu sendiri
            $tanggalMasuk = new \DateTime($bahan['tanggal_masuk']);
            $tanggalMasuk->setTime(0, 0, 0);

            $kadaluarsaDate = new \DateTime($bahan['tanggal_kadaluarsa']);
            $kadaluarsaDate->setTime(0, 0, 0);
            
            if ($bahan['jumlah'] <= 0) {
                $bahan['status_dihitung'] = 'habis';
            } 
            // Cek: Apakah tanggal masuk SUDAH MELEWATI tanggal kadaluarsa?
            else if ($tanggalMasuk >= $kadaluarsaDate) {
                $bahan['status_dihitung'] = 'kadaluarsa';
            }
            // Cek: Apakah selisih antara tanggal kadaluarsa dan tanggal masuk kurang dari 3 hari?
            else if ($kadaluarsaDate->diff($tanggalMasuk)->days <= 3) {
                $bahan['status_dihitung'] = 'segera_kadaluarsa';
            }
            // Jika tidak semuanya, berarti tersedia
            else {
                $bahan['status_dihitung'] = 'tersedia';
            }
            
            $bahan['status'] = $bahan['status_dihitung'];
            unset($bahan['status_dihitung']);

            $processedBahan[] = $bahan;
        }

        return $processedBahan;
    }
}