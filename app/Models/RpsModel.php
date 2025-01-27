<?php

namespace App\Models;

use CodeIgniter\Model;

class RpsModel extends Model
{
  protected $table = 'daftar_rps';
  protected $primaryKey = 'id';
  protected $allowedFields = ['user_id', 'kode_mk', 'jurusan_id', 'tahun_ajaran', 'semester', 'kelas', 'link_rps'];
  protected $useTimestamps = true;
  protected $returnType = 'array';
  protected $skipValidation = false;
}
