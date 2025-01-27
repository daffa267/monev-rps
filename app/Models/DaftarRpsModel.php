<?php

namespace App\Models;

use CodeIgniter\Model;

class DaftarRpsModel extends Model
{
  protected $table = 'daftar_rps';
  protected $primaryKey = 'id';
  protected $allowedFields = ['user_id', 'kode_mk', 'jurusan_id', 'kelas', 'link_rps', 'created_at', 'updated_at'];
  protected $useTimestamps = true;
  protected $returnType = 'object';

  public function getRpsList()
  {
    return $this->db->table('daftar_rps')
      ->select('daftar_rps.*, mata_kuliah.nama_mk, jurusan.nama_jurusan')
      ->join('mata_kuliah', 'mata_kuliah.kode_mk = daftar_rps.kode_mk')
      ->join('jurusan', 'jurusan.id = daftar_rps.jurusan_id')
      ->get()
      ->getResult();
  }
}
