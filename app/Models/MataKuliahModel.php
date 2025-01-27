<?php

namespace App\Models;

use CodeIgniter\Model;

class MataKuliahModel extends Model
{
  protected $table = 'mata_kuliah';
  protected $primaryKey = 'kode_mk';
  protected $allowedFields = ['kode_mk', 'nama_mk', 'id_jurusan'];
  protected $useTimestamps = false;
}
