<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';   // nama tabel di database
    protected $primaryKey = 'id';     // primary key
    protected $allowedFields = ['nim', 'nama', 'umur'];
}
